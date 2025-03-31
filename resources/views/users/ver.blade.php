@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Tu cuenta de usuario</h2>
    <p> Nombre de usuario : {{ $user->name }}</p>
    <p> Cuenta de correo : {{ $user->email }}</p>
    <!-- Enlace para editar los detalles de cada usuario -->
    <br>
    <a href="{{route('users.get', ['user' => $user->id])}}" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">Modificar datos</a>
</div>
@endsection
