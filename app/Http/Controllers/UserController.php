<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use AuthorizesRequests;

    // Método para devolver todos los usuarios
    public function index()
    {
        $users = User::get();
        return view('users.show', compact('users'));
    }

    // Método para registrar usuario
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        if (Auth::check()) {
            return redirect()->route('users.show');
        } else {
            Auth::login($user);
            return redirect()->route('main');
        }
    }

    // Método para iniciar sesión
    public function login(LoginUserRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('main');
        } else {
            return redirect()->route('auth.login.get')->withErrors([
                'email' => 'Las credenciales no coinciden con nuestros registros.',
            ]);
        }
    }

    // Método para cerrar sesión
    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login.get');
    }

    // Método para ver un único usuario
    public function ver(User $user)
    {
        $this->authorize('view', $user);
        return view('users.ver', compact('user'));
    }

    // Método para acceder a editar usuario
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    // Método para editar usuario
    public function update(EditUserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password
        ]);
        return redirect()->route('main');
    }

    // Método para eliminar usuario
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
        return redirect()->route('users.show');
    }
}
