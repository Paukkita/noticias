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
                <div class=" flex mt-6 justify-center ">
                    <img src="{{ Storage::url($noticia->imagen) }}" alt="Imagen de noticia" class="mt-2 w-60 h-auto">
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
                    <button type="submit" class=" py-3 px-6 border text-lg rounded  bg-white hover:bg-red-300 w-[400px] h-[100px]">
                        Eliminar Noticia
                    </button>
                </form>
            </div>
        @endcan
        @can('editar noticias')
            <!-- Botón de editar -->
            <div class="flex justify-center items-center text-center px-6 py-3 border hover:bg-yellow-300 w-[400px] h-[100px]">
                <a href="{{ route('noticias.edit.get', $noticia->id) }}" class=" text-lg rounded">
                    Editar noticia
                </a>
            </div>
        @endcan
        </div>

        <!-- Botón de volver -->
        <div class=" flex justify-center  text-center px-6 py-4 border mx-auto mb-2 hover:bg-blue-300 w-[400px]" >
            <a href="{{ route('main') }}" class="w-full py-3 px-6 text-lg rounded mt-4 ">
                Volver
            </a>
        </div>
    </div>
</div>
@endsection
