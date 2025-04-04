@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8 max-w-3xl">
    <h2 class="text-3xl font-semibold mb-6">Tu cuenta de usuario</h2>

    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
        <!-- Información del usuario -->
        <div class="mb-4">
            <p class="text-xl font-medium text-gray-700"><strong>Nombre de usuario:</strong> {{ $user->name }}</p>
        </div>

        <div class="mb-4">
            <p class="text-xl font-medium text-gray-700"><strong>Cuenta de correo:</strong> {{ $user->email }}</p>
        </div>

        <div class="mb-4">
            <p class="text-xl font-medium text-gray-700"><strong>Contraseña:</strong> #######</p>
        </div>

        <!-- Enlace para modificar datos -->
        <div class="mt-6 text-center">
            <a href="{{ route('users.get', ['user' => $user->id]) }}" class="inline-block py-2 px-4 text-lg font-medium text-gray-700 border-2 border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none">
                Modificar datos
            </a>
        </div>
    </div>
</div>
@endsection
