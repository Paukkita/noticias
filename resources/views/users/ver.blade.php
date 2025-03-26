@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Tu cuenta de usuario</h2>
    <p> Nombre de usuario : {{ $user->name }}</p>
    <p> Cuenta de correo : {{ $user->email }}</p>
</div>
@endsection
