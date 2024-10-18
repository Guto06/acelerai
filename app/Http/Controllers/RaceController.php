<?php

namespace App\Http\Controllers;

use App\Models\Race; // Importando o modelo Race
use Illuminate\Http\Request;

class RaceController extends Controller
{
    // Exibir uma lista de todas as corridas
    public function index()
    {
        $races = Race::all(); // Recupera todas as corridas do banco de dados
        return view('races.index', compact('races')); // Passa as corridas para a view
    }

    // Exibir o formulário para criar uma nova corrida
    public function create()
    {
        return view('races.create'); // Retorna a view para criar uma nova corrida
    }

    // Armazenar uma nova corrida no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'max_vehicles' => 'required|integer',
            'date' => 'required|date',
        ]);

        Race::create($request->all()); // Cria a nova corrida com os dados recebidos
        return redirect()->route('races.index')->with('success', 'Corrida criada com sucesso!'); // Redireciona para a lista de corridas
    }

    // Exibir uma corrida específica
    public function show(Race $race)
    {
        return view('races.show', compact('race')); // Passa a corrida para a view
    }

    // Exibir o formulário para editar uma corrida existente
    public function edit(Race $race)
    {
        return view('races.edit', compact('race')); // Passa a corrida para a view de edição
    }

    // Atualizar uma corrida existente no banco de dados
    public function update(Request $request, Race $race)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'max_vehicles' => 'required|integer',
            'date' => 'required|date',
        ]);

        $race->update($request->all()); // Atualiza a corrida com os dados recebidos
        return redirect()->route('races.index')->with('success', 'Corrida atualizada com sucesso!'); // Redireciona para a lista de corridas
    }

    // Remover uma corrida do banco de dados
    public function destroy(Race $race)
    {
        $race->delete(); // Exclui a corrida
        return redirect()->route('races.index')->with('success', 'Corrida excluída com sucesso!'); // Redireciona para a lista de corridas
    }
}
