<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Vehicle;

class DashboardController extends Controller
{
    public function dashboardAdministrator()
    {
        $user = Auth::user();
        if (!$user->is_administrator) {
            return redirect('/')->with('msg', 'Você não tem permissão para acessar essa página');
        }
        // Busca apenas os usuários que não foram validados
        $users = User::where('is_validated', false)->get();
        return view('dashboard', compact('users'));
    }

    public function dashboardUser()
    {
        $user = Auth::user();
        if ($user->is_administrator) {
            return redirect('/')->with('msg', 'Você não tem permissão para acessar essa página');
        }
        $vehicles = Vehicle::where('user_id', $user->id)->get();
        return view('userDashboard', ['vehicles' => $vehicles]);
    }

    public function indexAdmin()
    {
        $user = Auth::user();
        if (!$user->is_administrator) {
            return redirect('/')->with('msg', 'Você não tem permissão para acessar essa página');
        }
        return view('admin.index');
    }

    // Função para validar o usuário
    public function validateUser($id)
    {
        $user = Auth::user();
        if (!$user->is_administrator) {
            return redirect('/')->with('msg', 'Você não tem permissão para acessar essa página');
        }
        // Busca o usuário pelo ID
        $user = User::find($id);

        // Verifica se o usuário foi encontrado
        if (!$user) {
            return redirect('/dashboard')->with('msg', "Usuário não encontrado");
        }

        // Atualiza o campo `is_validated` para true (usuário validado)
        $user->is_validated = true;
        $user->save();

        return redirect('/dashboard')->with('msg', "{$user->name} foi validado com sucesso");
    }

    public function documentUser($id)
    {
        $user = Auth::user();
        if (!$user->is_administrator) {
            return redirect('/')->with('msg', 'Você não tem permissão para acessar essa página');
        }
        // Busca o usuário pelo ID
        $user = User::find($id);

        // Verifica se o usuário foi encontrado e possui o caminho do documento
        if (!$user || !$user->license_path) {
            return redirect('/dashboard')->with('msg', 'Usuário ou documento não encontrado');
        }

        // Gera a URL completa para o documento do usuário
        $filePath = storage_path($user->license_path);

        // Verifica se o arquivo existe antes de tentar abri-lo
        if (!file_exists($filePath)) {
            return redirect('/dashboard')->with('msg', 'Arquivo não encontrado');
        }

        // Retorna o PDF para ser exibido no navegador
        return response()->file($filePath);
    }

    public function indexUsers()
    {
        $user = Auth::user();
        if (!$user->is_administrator) {
            return redirect('/')->with('msg', 'Você não tem permissão para acessar essa página');
        }
        $pilots = User::all();
        return view('admin.user', compact('pilots'));
    }
}
