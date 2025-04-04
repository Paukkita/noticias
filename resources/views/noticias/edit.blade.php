@extends('layouts.app')

@section('content')
<div class="p-8">
    
<!-- Formulario para editar una noticia -->
<form method="POST" action="{{ route('noticias.edit.put', $noticia->id) }}" class="space-y-4" enctype="multipart/form-data">
    @method('PUT') <!-- Especifica que esta es una solicitud PUT -->
    @csrf   <!-- Token de seguridad CSRF -->

    <h2 class="text-2xl font-bold mb-4 text-center"> Editar noticia {{ $noticia->id }}</h2>

    <!-- Mostrar errores de validación si los hay -->
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

    <!-- Campo para editar el título de la noticia -->
    <div>
        <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
        <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $noticia->titulo) }}" required
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
    </div>

    <!-- Campo para editar la fecha de publicación -->
    <div>
        <label for="fecha_publicacion" class="block text-sm font-medium text-gray-700">Fecha de Publicación</label>
        <input type="date" id="fecha_publicacion" name="fecha_publicacion" value="{{ old('fecha_publicacion', $noticia->fecha_publicacion) }}" required
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
    </div>

    <!-- Campo para editar la descripción de la noticia -->
    <div>
        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
        <textarea id="descripcion" name="descripcion" rows="4" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">{{ old('descripcion', $noticia->descripcion) }}</textarea>
    </div>

    <!-- Campo para subir una nueva imagen (opcional) -->
    <div>
        <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen (Opcional)</label>
        <input type="file" id="imagen" name="imagen" accept="image/*"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
    </div>

    <!-- Selección del género de la noticia -->
    <div>
        <label for="genero_id" class="block text-sm font-medium text-gray-700">Género</label>
        <select name="genero_id" id="genero_id">
        <option value="">Seleccione un género</option>
        @foreach ($generos as $genero)
        <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
        @endforeach
        </select>
    </div>

    <!-- Botón para enviar el formulario y actualizar la noticia -->
    <div class="flex items-center justify-between">
        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none">
            Publicar Noticia
        </button>
    </div>
</form>
@endsection

</div>