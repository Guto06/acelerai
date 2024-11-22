<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Validation\Rule;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $userLogado = Auth::user();

        if (!$userLogado->is_administrator) {
            return redirect('/')->with('msg', 'Você não tem permissão para acessar essa página');
        }
        return view('admin.edit-user', [
            'user' => $user,
        ]);
    }

    public function showProfile($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $vehicles = Vehicle::where('user_id', $user->id)->get();

        return view('profile.profile', compact('user', 'vehicles'));
    }


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updateUser(Request $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $userLogado = Auth::user();

        if (!$userLogado->is_administrator) {
            return redirect('/')->with('msg', 'Você não tem permissão para acessar essa página');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'username' => [
                'required',
                'string',
                'max:40',
                Rule::unique('users')->ignore($user->id),
            ],
            'number' => 'required|string|max:11|unique:users,number,' . $user->id,
            'age' => 'required|date|before:today',
        ]);

        $user->fill($request->all());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();


        Vehicle::where('user_id', $user->id)->delete();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function destroyAdm(Request $request, $id): RedirectResponse
    {
        // Verifica se o usuário logado é um administrador
        if (Auth::user()->is_administrator) {
            $user = User::findOrFail($id); // Busca o usuário pelo ID


            // Exclui os veículos associados ao usuário
            Vehicle::where('user_id', $user->id)->delete();
            $user->delete(); // Exclui o usuário

            return back()->with('msg', 'Usuário excluído com sucesso.');
        }

        // Se o usuário não for administrador, redireciona com mensagem de erro
        return back()->with('msg', 'Ação não permitida.');
    }
}
