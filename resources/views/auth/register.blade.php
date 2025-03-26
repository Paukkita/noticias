@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto mt-12 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-4 text-center">Registrarse</h2>

        {{-- Incluir el formulario de login --}}
        <x-form />
    </div>
@endsection
