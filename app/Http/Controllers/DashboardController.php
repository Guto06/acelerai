<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $users = User::all();
        return view('dashboard', compact('users'));
    }

    // Função para validar o usuário
    public function validateUser($id) {
        // Busca o usuário pelo ID
        $user = User::find($id);

        // Verifica se o usuário foi encontrado
        if (!$user) {
            return redirect()->back()->with('error', 'Usuário não encontrado');
        }

        // Atualiza o campo `is_validated` para true (usuário validado)
        $user->is_validated = true;
        $user->save();

        return redirect()->back()->with('success', 'Usuário validado com sucesso!');
    }
}
