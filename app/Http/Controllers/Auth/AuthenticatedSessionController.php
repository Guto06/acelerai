<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Autentica o usuário
        $request->authenticate();
    
        // Verifica se o usuário é válido antes de regenerar a sessão
        if (!Auth::user()->is_validated) {
            Auth::logout(); // Desloga o usuário se ele não for válido
            return redirect('/login')->with('msg', 'Sua conta ainda não foi validada. Por favor, aguarde a validação.');
        }
    
        // Regenera o token da sessão após a validação
        $request->session()->regenerate();
    
        // Verifica se o usuário não é administrador
        if (!Auth::user()->is_administrator) {
            return redirect('/dashboard/user');
        }
    
        // Redireciona para o painel do administrador
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
