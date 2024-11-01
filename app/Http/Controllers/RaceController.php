<?php

namespace App\Http\Controllers;

use App\Models\Race; // Importando o modelo Race
use Illuminate\Support\Facades\Auth; // Importando o facade Auth
use App\Models\RaceVehicle; // Importando o modelo RaceVehicle
use Illuminate\Http\Request;

class RaceController extends Controller
{
    // Exibir uma lista de todas as corridas
    public function index()
    {
        $currentDate = now(); // Data atual

        // Recupera as corridas futuras
        $upcomingRaces = Race::where('date_time', '>=', $currentDate)
            ->orderBy('date_time', 'asc') // Ordena pela data e hora corretas
            ->get();

        // Recupera as corridas passadas
        $pastRaces = Race::where('date_time', '<', $currentDate)
            ->orderBy('date_time', 'desc') // Ordena pela data e hora corretas
            ->get();

        return view('races.index', compact('upcomingRaces', 'pastRaces'));
    }


    // Exibir o formulário para criar uma nova corrida
    public function create()
    {
        $user = Auth::user();
        if (!$user->is_administrator) {
            return redirect('/')->with('msg', 'Você não tem permissão para acessar essa página');
        }
        return view('races.create'); // Retorna a view para criar uma nova corrida
    }

    // Armazenar uma nova corrida no banco de dados
    public function store(Request $request)
    {
        $user = Auth::user();

        // Verifica se o usuário é administrador
        if (!$user->is_administrator) {
            return redirect('/')->with('msg', 'Você não tem permissão para acessar essa página');
        }

        // Valida os dados do formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:1',
            'max_vehicles' => 'required|integer|max:10',
            'date_time' => 'required|date_format:Y-m-d\TH:i',
            'start_latitude' => 'required|numeric',   // Validação da latitude de largada
            'start_longitude' => 'required|numeric',  // Validação da longitude de largada
            'end_latitude' => 'required|numeric',     // Validação da latitude de chegada
            'end_longitude' => 'required|numeric',    // Validação da longitude de chegada
        ]);

        // Cria a corrida no banco de dados
        Race::create([
            'name' => $request->name,
            'category' => $request->category,
            'max_vehicles' => $request->max_vehicles,
            'date_time' => $request->date_time,
            'start_latitude' => $request->start_latitude,
            'start_longitude' => $request->start_longitude,
            'end_latitude' => $request->end_latitude,
            'end_longitude' => $request->end_longitude,
        ]);

        // Redireciona para a lista de corridas com mensagem de sucesso
        return redirect()->route('races.index')->with('success', 'Corrida criada com sucesso!');
    }

    // Exibir uma corrida específica
    public function show(Race $race)
    {
        return view('races.show', compact('race')); // Passa a corrida para a view
    }

    // Exibir o formulário para editar uma corrida existente
    public function edit(Race $race)
    {
        $user = Auth::user();
        if (!$user->is_administrator) {
            return redirect('/')->with('msg', 'Você não tem permissão para acessar essa página');
        }
        return view('races.edit', compact('race')); // Passa a corrida para a view de edição
    }

    // Atualizar uma corrida existente no banco de dados
    public function update(Request $request, Race $race)
    {
        $user = Auth::user();
        if (!$user->is_administrator) {
            return redirect('/')->with('msg', 'Você não tem permissão para acessar essa página');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'max_vehicles' => 'required|integer',
            'date' => 'required|date',
            'start_location' => 'required|string|max:255',
            'start_latitude' => 'required|numeric',   // Validação da latitude de largada
            'start_longitude' => 'required|numeric',  // Validação da longitude de largada
            'end_location' => 'required|string|max:255',
            'end_latitude' => 'required|numeric',     // Validação da latitude de chegada
            'end_longitude' => 'required|numeric',    // Validação da longitude de chegada
        ]);

        $race->update($request->all()); // Atualiza a corrida com os dados recebidos
        return redirect()->route('races.index')->with('success', 'Corrida atualizada com sucesso!'); // Redireciona para a lista de corridas
    }

    // Remover uma corrida do banco de dados
    public function destroy(Race $race)
    {
        $user = Auth::user();
        if (!$user->is_administrator) {
            return redirect('/')->with('msg', 'Você não tem permissão para acessar essa página');
        }
        $race->delete(); // Exclui a corrida
        return redirect()->route('races.index')->with('success', 'Corrida excluída com sucesso!'); // Redireciona para a lista de corridas
    }

    public function participate($raceId)
    {
        // Recupera a corrida
        $race = Race::findOrFail($raceId);

        if (now()->greaterThan($race->date_time)) {
            return redirect()->back()->with('error', 'Esta corrida já ocorreu, não é possível mais participar.');
        }

        // Recupera o veículo do usuário
        $vehicle = Auth::user()->vehicles()->where('category', $race->category)->first();

        // Verifica se o usuário possui um veículo que pertence à mesma categoria da corrida
        if (!$vehicle) {
            return redirect()->back()->with('error', 'Você não possui um veículo na categoria desta corrida.');
        }

        // Verifica se o número máximo de veículos já foi atingido
        if ($race->vehicles()->count() >= $race->max_vehicles) {
            return redirect()->back()->with('error', 'A corrida já atingiu o número máximo de participantes.');
        }

        // Adiciona o veículo do usuário à corrida
        $race->vehicles()->attach($vehicle->id);

        return redirect()->back()->with('success', 'Você foi adicionado à corrida com sucesso.');
    }

    public function getEligibleVehicles($raceId)
    {
        $race = Race::findOrFail($raceId);
        $user = Auth::user();

        // Busca os veículos do usuário que pertencem à mesma categoria da corrida
        $vehicles = $user->vehicles()->where('category', $race->category)->get();

        return response()->json([
            'vehicles' => $vehicles
        ]);
    }

    public function showEnterResultsForm($raceId)
    {
        $race = Race::with('vehicles')->findOrFail($raceId);

        // Obter IDs dos veículos que já possuem pontuação
        $vehiclesWithResults = RaceVehicle::where('race_id', $raceId)->whereNotNull('points')->pluck('vehicle_id')->toArray();

        // Filtrar veículos que ainda não têm resultados
        $availableVehicles = $race->vehicles->filter(function ($vehicle) use ($vehiclesWithResults) {
            return !in_array($vehicle->id, $vehiclesWithResults);
        });

        // Obter posições já ocupadas na corrida
        $occupiedPositions = RaceVehicle::where('race_id', $raceId)->pluck('position')->toArray();

        return view('races.enter_results', [
            'race' => $race,
            'availableVehicles' => $availableVehicles,
            'occupiedPositions' => $occupiedPositions
        ]);
    }



    function calculatePoints($time, $fuelConsumption, $averageSpeed, $carCondition, $position)
    {
        $points = 0;

        // Convertendo tempo de string para horas (em formato decimal)
        $timeParts = explode(':', $time);
        $timeInHours = $timeParts[0] + ($timeParts[1] / 60) + ($timeParts[2] / 3600);

        // Pontos pelo tempo (menor tempo ganha mais)
        $timePoints = 1000 / $timeInHours;  // Exemplo de cálculo baseado no tempo

        // Pontos pelo consumo (menor consumo ganha mais)
        $fuelPoints = 500 / $fuelConsumption;

        // Pontos pela velocidade média (maior velocidade ganha mais)
        $speedPoints = $averageSpeed * 10;

        // Pontos pelo estado do carro
        switch ($carCondition) {
            case 'excellent':
                $conditionPoints = 100;
                break;
            case 'good':
                $conditionPoints = 75;
                break;
            case 'fair':
                $conditionPoints = 50;
                break;
            case 'poor':
                $conditionPoints = 25;
                break;
            default:
                $conditionPoints = 0;
                break;
        }

        // Pontos pela posição na corrida
        $positionPoints = max(0, 500 - ($position - 1) * 100);

        // Somando todos os pontos
        $points = $timePoints + $fuelPoints + $speedPoints + $conditionPoints + $positionPoints;

        return round($points);
    }

    public function enterResults(Request $request, $raceId, $vehicleId)
    {
        // Validação dos dados
        $validated = $request->validate([
            'position' => 'required|integer|between:1,10',
            'time' => 'required|date_format:H:i:s',
            'fuel_consumption' => 'required|numeric',
            'average_speed' => 'required|numeric',
            'car_condition' => 'required|in:excellent,good,fair,poor',
        ]);

        // Recupera o registro da corrida e do veículo
        $raceVehicle = RaceVehicle::where('race_id', $raceId)
            ->where('vehicle_id', $vehicleId)
            ->firstOrFail();

        // Calcula a pontuação usando a nova função
        $points = $this->calculatePoints(
            $validated['time'],
            $validated['fuel_consumption'],
            $validated['average_speed'],
            $validated['car_condition'],
            $validated['position']
        );

        // Atualiza o registro com os resultados e a pontuação
        $raceVehicle->update([
            'position' => $validated['position'],
            'time' => $validated['time'],
            'fuel_consumption' => $validated['fuel_consumption'],
            'average_speed' => $validated['average_speed'],
            'car_condition' => $validated['car_condition'],
            'points' => $points,
        ]);

        return redirect()->back()->with('msg', 'Resultados inseridos com sucesso!');
    }
}
