@extends('layouts.app')

@section('content')
    <!-- Contenedor principal para los detalles de los usuarios -->
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Detalles de los Usuarios</h2>  <!-- Título principal -->

        <!-- Sección para mostrar la lista de usuarios -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <!-- Recorremos todos los usuarios que se pasan desde el controlador -->
            @foreach ($users as $user)
                <div class="bg-white shadow-md rounded-lg p-4"> <!-- Tarjeta de cada usuario -->
                    <!-- Nombre del usuario -->
                    <p><strong>Nombre:</strong> {{ $user->name }}</p>

                    <!-- Correo electrónico del usuario -->
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <br>
                    <!-- Enlace para editar los detalles de cada usuario -->
                    <a href="{{route('users.get', ['user' => $user->id])}}" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">Editar usuario</a>
                    
                    <!-- Formulario para eliminar un usuario -->
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="px-6 py-4 text-center">
                        @csrf  <!-- Token de seguridad CSRF -->
                        @method('DELETE')  <!-- Método HTTP DELETE para eliminar el usuario -->
                        <button type="submit" class="w-full py-3 px-6 border text-lg rounded mt-4">Eliminar usuario</button>
                    </form>
                </div>
            @endforeach
        </div>

        <!-- Formulario para redirigir al registro de nuevos usuarios -->
        <form action="{{ route('auth.register.get') }}" method="get">
            <p class="text-m text-gray-600 mb-4">
                <!-- Botón para registrar nuevos usuarios -->
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 mt-2">
                    Regístrar usuarios
                </button>
            </p>
        </form>
    </div>
@endsection
