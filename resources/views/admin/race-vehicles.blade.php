<x-app-layout>
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Pilotos na Corrida: {{ $race->name }}</h1>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Piloto - Veículo</th>
                    <th class="py-2 px-4 border-b">Posição</th>
                    <th class="py-2 px-4 border-b">Tempo</th>
                    <th class="py-2 px-4 border-b">Consumo de Combustível</th>
                    <th class="py-2 px-4 border-b">Velocidade Média</th>
                    <th class="py-2 px-4 border-b">Condição do Carro</th>
                    <th class="py-2 px-4 border-b">Pontos</th>
                    <th class="py-2 px-4 border-b">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($raceVehicles as $raceVehicle)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $raceVehicle->vehicle->user->name }} - {{ $raceVehicle->vehicle->model }}</td>
                        <td class="py-2 px-4 border-b">{{ $raceVehicle->position }}</td>
                        <td class="py-2 px-4 border-b">{{ $raceVehicle->time }}</td>
                        <td class="py-2 px-4 border-b">{{ $raceVehicle->fuel_consumption }}</td>
                        <td class="py-2 px-4 border-b">{{ $raceVehicle->average_speed }}</td>
                        <td class="py-2 px-4 border-b">{{ $raceVehicle->car_condition }}</td>
                        <td class="py-2 px-4 border-b">{{ $raceVehicle->points }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('admin.race-vehicles.edit', [$race->id, $raceVehicle->vehicle->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Editar</a>
                            <form action="{{ route('admin.race-vehicles.delete', [$race->id, $raceVehicle->vehicle->id]) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>