@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-6xl">
    <!-- Tarjeta principal -->
    <div class="bg-white rounded-xl shadow-xl overflow-hidden">
        <!-- Cabecera con título -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 py-8 px-6">
            <h1 class="text-4xl md:text-5xl font-bold text-center text-white font-sans">{{ $noticia->titulo }}</h1>
        </div>

        <!-- Contenido principal -->
        <div class="p-6 md:p-8 flex flex-col lg:flex-row gap-8">
            <!-- Sección de texto -->
            <div class="flex-1">
                <!-- Metadatos -->
                <div class="flex flex-col sm:flex-row gap-4 mb-6">
                    <div class="bg-blue-50 px-4 py-2 rounded-lg">
                        <p class="text-sm text-blue-800 font-semibold">Fecha de Publicación</p>
                        <p class="text-lg font-medium">{{ $noticia->fecha_publicacion }}</p>
                    </div>
                    <div class="bg-purple-50 px-4 py-2 rounded-lg">
                        <p class="text-sm text-purple-800 font-semibold">Género</p>
                        <p class="text-lg font-medium">{{ $noticia->genero->genero }}</p>
                    </div>
                </div>

                <!-- Descripción -->
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Descripción</h3>
                    <div class=" max-w-[400px] text-gray-700 border-l-4 border-blue-500 pl-4 py-2 break-words overflow-hidden ">
                        {{ $noticia->descripcion }}
                    </div>
                </div>
            </div>

            <!-- Imagen -->
            @if ($noticia->imagen)
            <div class="lg:w-1/2 flex-shrink-0">
                <div class="rounded-xl overflow-hidden shadow-lg">
                    <img src="{{ Storage::url($noticia->imagen) }}" alt="Imagen de noticia"
                        class="w-full h-auto object-cover transition-transform duration-300 hover:scale-105">
                </div>
            </div>
            @endif
        </div>

        <!-- Acciones -->
        <div class="px-6 pb-6">
            <!-- Botones de administración -->
            <div class="flex flex-col sm:flex-row justify-center gap-4 mb-6">
                @can('eliminar noticias')
                <form action="{{ route('noticias.destroy', $noticia->id) }}" method="POST" onsubmit="confirmarEliminar(this)">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="flex items-center justify-center gap-2 px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors duration-300 w-full sm:w-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Eliminar Noticia
                    </button>
                </form>
                @endcan

                @can('editar noticias')
                <a href="{{ route('noticias.edit.get', $noticia->id) }}"
                    class="flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-300 w-full sm:w-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Editar Noticia
                </a>
                @endcan
            </div>

            <!-- Botón de volver -->
            <div class="text-center">
                <a href="{{ route('main') }}"
                    class="inline-flex items-center px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Volver al Inicio
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmarEliminar(form) {
        event.preventDefault();
        Swal.fire({
            title: "¿Estás seguro de eliminar esta noticia?",
            text: "¡Esta acción no se puede deshacer!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>
@endsection