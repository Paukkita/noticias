@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="card shadow-lg rounded-lg overflow-hidden bg-white mx-auto">
        <!-- Título de la noticia -->
        <div class="card-header py-6">
            <h2 class="text-4xl text-center font-bold">{{ $noticia->titulo }}</h2>
        </div>
        
        <!-- Contenido de la noticia -->
        <div class="card-body p-6 text-center">
            <p class="text-xl font-semibold"><strong>Fecha de Publicación:</strong> {{ $noticia->fecha_publicacion }}</p>
            <p class="text-xl font-semibold"><strong>Género:</strong> {{ $noticia->genero }}</p>
            <p class="text-xl font-semibold"><strong>Descripción:</strong></p>
            <p class="text-lg">{{ $noticia->descripcion }}</p>

            <!-- Imagen de la noticia -->
            @if ($noticia->imagen)
                <div class="mt-6">
                    <img src="{{ asset('storage/' . $noticia->imagen) }}" alt="Imagen de la noticia" class="mx-auto w-96 h-auto rounded">
                </div>
            @endif
        </div>

        <!-- Formulario de eliminación -->
        <form action="{{ route('noticias.destroy', $noticia->id) }}" method="POST" class="px-6 py-4 text-center">
            @csrf
            @method('DELETE')
            <button type="submit" class="w-full py-3 px-6 border text-lg rounded mt-4">Eliminar Noticia</button>
        </form>

        <!-- Botón de editar -->
        <div class="card-footer text-center px-6 py-4">
            <a href="{{ route('noticias.edit.get', $noticia->id) }}" class="btn btn-secondary py-3 px-6 border text-lg rounded mt-4">Editar noticia</a>
        </div>

        <!-- Botón de volver -->
        <div class="card-footer text-center px-6 py-4">
            <a href="{{ route('main') }}" class="btn btn-secondary py-3 px-6 border text-lg rounded mt-4">Volver</a>
        </div>
    </div>
</div>
@endsection
