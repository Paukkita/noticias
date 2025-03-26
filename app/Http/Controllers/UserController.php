<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController
{ 
    //Metodo para devolver todos los usuarios
    public function index(){
        $users=User::get();
        return view('users.show', compact('users'));
    }
    //Metodo para registrar usuario
    public function store(StoreUserRequest $request){
        $user=User::create($request->all());
        if (Auth::check()) {
            return redirect()->route('users.show');
        }else{
            Auth::login($user);
            return redirect()->route('main');
        }
    }
    //Metodo para iniciar sesion
    public function login(LoginUserRequest $request){
        $user=User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
        return redirect()->route('main');
        }else{
            return redirect()->route('auth.login.get')->withErrors([
                'email' => 'Las credenciales no coinciden con nuestros registros.',
            ]);
        }
    }

    //Metodo para cerrar sesion
    public function logout(){
        Auth::logout();
        return redirect()->route('auth.login.get');
    }

    //Metodo para ver un unico usuario
    public function ver(User $user){
        return view('users.ver', compact('user'));
    }
    //Metodo para acceder editar usuario
    public function edit(User $user){
        return view('users.edit', compact('user'));
    }

    //Metodo para editar usuario
    public function update(EditUserRequest $request, User $user){
        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        return redirect()->route('users.show');
    }
    //Metodo para eliminar usuario
    public function destroy($user){
        $user=User::find($user);
        $user->delete();
        return redirect()->route('users.show');
    }
}