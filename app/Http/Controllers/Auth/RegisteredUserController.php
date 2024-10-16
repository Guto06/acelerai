<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:40|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'number' => 'required|string|max:11|unique:users',
            'birthdate' => 'required|date|before:today',
            'license_pdf' => 'required|mimes:pdf|max:2048',  // Validação para o PDF
        ]);

        // Criação da pasta com base no nome do usuário
        $username = $request->username;
        Storage::put($request->username . '/' . $request->username . '_cnh.pdf', $request->license_pdf->get());
        // Salvando o arquivo com nome customizado
        $path_pdf = 'app/private/' . $request->username . '/' . $request->username . '_cnh.pdf';

        // Criação do usuário
        $user = User::create([
            'name' => $request->name,
            'username' => $username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'number' => $request->number,
            'age' => $request->birthdate,
            'license_path' => $path_pdf,  // Salvando o caminho no banco de dados
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
