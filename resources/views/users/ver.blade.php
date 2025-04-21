@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8 max-w-3xl">
    <h2 class="text-3xl font-bold mb-8 text-gray-800">👤 Tu cuenta</h2>

    <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200 space-y-6">
        <!-- Información del usuario -->
        <div class="space-y-2">
            <p class="text-sm  text-white bg-teal-600 p-2 uppercase w-[200px]">Nombre de usuario:</p>
            <p class="text-lg font-semibold text-gray-800">{{ $user->name }}</p>
            <br>
        </div>

        <div class="space-y-2">
            <p class="text-sm  text-white bg-teal-600 p-2 uppercase w-[200px]">Correo electrónico:</p>
            <p class="text-lg font-semibold text-gray-800">{{ $user->email }}</p>
            <br>
        </div>

       {{--  <div class="space-y-2">
            <p class="text-sm text-white bg-teal-600 p-2 uppercase w-[200px]">Contraseña</p>
            <p class="text-lg font-semibold text-gray-800">•••••••</p>
            <br>
        </div> --}}

        <!-- Enlace para modificar datos -->
        <div class="pt-4 border-t border-gray-100 text-right">
            <a href="{{ route('users.get', ['user' => $user->id]) }}"
                class="inline-block py-2 px-6 text-white bg-blue-600 hover:bg-teal-700 transition-colors duration-200 rounded-md text-sm font-medium shadow">
                ✏️ Modificar datos
            </a>
        </div>
    </div>
</div>
@endsection
