<?php

namespace App\Http\Controllers;

use App\Models\Race; // Importando o modelo Race
use Illuminate\Support\Facades\Auth; // Importando o facade Auth
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
        $user = Auth::user();
        if(!$user->is_administrator){
            return redirect('/')->with('msg', 'Você não tem permissão para acessar essa página');
        }
        return view('races.create'); // Retorna a view para criar uma nova corrida
    }

    // Armazenar uma nova corrida no banco de dados
    public function store(Request $request)
    {
        $user = Auth::user();
        if(!$user->is_administrator){
            return redirect('/')->with('msg', 'Você não tem permissão para acessar essa página');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:1',
            'max_vehicles' => 'required|integer|max:10',
            'date' => 'required|date',
            'start_location' => 'required|string|max:255',
            'start_latitude' => 'required|numeric',   // Validação da latitude de largada
            'start_longitude' => 'required|numeric',  // Validação da longitude de largada
            'end_location' => 'required|string|max:255',
            'end_latitude' => 'required|numeric',     // Validação da latitude de chegada
            'end_longitude' => 'required|numeric',    // Validação da longitude de chegada
        ]);
    
        Race::create($request->all());
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
        if(!$user->is_administrator){
            return redirect('/')->with('msg', 'Você não tem permissão para acessar essa página');
        }
        return view('races.edit', compact('race')); // Passa a corrida para a view de edição
    }

    // Atualizar uma corrida existente no banco de dados
    public function update(Request $request, Race $race)
    {
        $user = Auth::user();
        if(!$user->is_administrator){
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
        if(!$user->is_administrator){
            return redirect('/')->with('msg', 'Você não tem permissão para acessar essa página');
        }
        $race->delete(); // Exclui a corrida
        return redirect()->route('races.index')->with('success', 'Corrida excluída com sucesso!'); // Redireciona para a lista de corridas
    }
}
