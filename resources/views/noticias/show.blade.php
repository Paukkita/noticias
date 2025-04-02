@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="card shadow-lg rounded-lg overflow-hidden bg-white mx-auto">
        <!-- Título de la noticia -->
        <div class="card-header py-6">
            <h2 class="text-4xl text-center font-bold font-[Roboto]">{{ $noticia->titulo }}</h2>
        </div>
        
<!-- Contenido de la noticia -->
<div class="card-body p-8  text-center max-w-2xl mx-auto">
    <!-- Fecha y Género -->
    <div class="mb-4">
        <p class="text-xl font-semibold text-gray-700"><strong>Fecha de Publicación:</strong> {{ $noticia->fecha_publicacion }}</p>
        <p class="text-xl font-semibold text-gray-700"><strong>Género:</strong> {{ $noticia->genero }}</p>
    </div>

    <!-- Descripción -->
    <div class="mb-6">
        <p class="text-xl font-semibold text-gray-700"> <strong> Descripción : </strong></p>
        <p class="text-lg break-words text-gray-600 border border-gray-400 p-4 rounded-md bg-gray-100 w-full max-w-[500px] mx-auto">
            {{ $noticia->descripcion }}
        </p>
    </div>

    <!-- Imagen de la noticia -->
    @if ($noticia->imagen)
        <div class="flex justify-center">
            <img src="{{ Storage::url($noticia->imagen) }}" alt="Imagen de noticia" class="mt-4 w-80 h-auto rounded-lg shadow-md">
        </div>
    @endif
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
                        form.submit();  // Envía el formulario si el usuario confirma
                    }
                });
            }
        </script>
        
        <div class="flex justify-center gap-7 mb-5">
            @can('eliminar noticias')
            <div>
                <!-- Formulario de eliminación con confirmación de SweetAlert -->
                <form action="{{ route('noticias.destroy', $noticia->id) }}" method="POST" class="text-center" onsubmit="confirmarEliminar(this)">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class=" py-3 px-6 border text-lg rounded  bg-red-400 hover:bg-red-300 w-[300px] h-[100px] uppercase font-[Poppins]">
                        Eliminar Noticia
                    </button>
                </form>
            </div>
        @endcan
        @can('editar noticias')
            <!-- Botón de editar -->
            <div class="flex justify-center items-center text-center px-6 py-3 border bg-blue-400 hover:bg-blue-300 w-[300px] h-[100px] uppercase font-[Poppins]">
                <a href="{{ route('noticias.edit.get', $noticia->id) }}" class=" text-lg rounded">
                    Editar noticia
                </a>
            </div>
        @endcan
        </div>

        <!-- Botón de volver -->
        <div class=" flex justify-center  text-center px-6 py-4 border mx-auto mb-2 bg-blue-400 hover:bg-blue-300 w-[200px] uppercase" >
            <a href="{{ route('main') }}" class="w-full text-lg rounded font-[Poppins]">
                Volver
            </a>
        </div>
    </div>
</div>
@endsection
