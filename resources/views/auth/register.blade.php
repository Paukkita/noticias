@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto mt-24 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold mb-4 text-center font-[Roboto]">Registrarse</h2>

        {{-- Incluir el formulario de login --}}
        <x-form />
        <p class="text-sm text-gray-600 mt-4 text-center">
                ¿Ya tienes cuenta? <a href="{{ route('auth.login.get') }}" class="hover:text-blue-400">Regístrate aquí</a> 
        </p>
    </div>
@endsection
