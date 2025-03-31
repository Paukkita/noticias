@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="p-4 bg-red-100 text-red-700 rounded">
            <h2 class="font-bold">Errores</h2>
            <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
    <!-- Formulario para modificar un usuario -->
    <form method="POST" action="{{ route('users.put', $user->id) }}" class="space-y-4">
        @csrf  <!-- Token de seguridad CSRF -->
        @method('PUT')  <!-- Método PUT para la actualización -->

        <!-- Verificación y visualización de errores -->
        @if ($errors->any())  
        <div class="p-4 bg-red-100 text-red-700 rounded">
            <h2 class="font-bold">Errores</h2>
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Campo para el nombre del usuario -->
        <div>
            <label for="user" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" id="user" value="{{ old('name', $user->name) }}" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Campo para el correo electrónico del usuario -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
            <input type="email" id="email" value="{{ old('email', $user->email) }}" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Campo para la contraseña del usuario -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
            <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        </div>
        <!-- Botón para enviar el formulario -->
        <div class="flex items-center justify-between">
            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none">
                Modificar usuario
            </button>
        </div>
    </form>
@endsection
