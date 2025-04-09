@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto mt-24 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold mb-4 text-center font-[Roboto]">Iniciar sesión</h2>

        {{-- Incluir el formulario de login --}}
        <x-form />

        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                ¿No tienes cuenta? <a href="{{ route('auth.register.get') }}" class="hover:text-blue-400">Regístrate aquí</a> 
            </p>
        </div>
    </div>
@endsection