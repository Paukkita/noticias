@extends('layouts.app')

@section('content')
    <!-- Barra superior con el nombre del usuario loggeado -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-center">Noticias</h2>
        <div class="text-right">
            @auth <!-- Si el usuario está autenticado -->
                <p class="text-sm">Bienvenido, {{ Auth::user()->name }}  
                    <!-- Enlace para cerrar sesión -->
                    <a href="{{ route('auth.login.get') }}" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar sesión
                    </a>
                </p> 
                <form id="logout-form" action="{{ route('auth.login.get') }}" method="GET" class="hidden"></form>
            @endauth
        </div>
    </div>
    
    <!-- Botón para crear una noticia, visible solo si el usuario tiene permiso -->
    @can('crear noticias')
        <div class="mb-4">
            <a href="{{ route('noticias.create.get') }}" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                Crear Noticia
            </a>
        </div>
    @endcan

    <!-- Lista de Noticias -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($noticias as $noticia)
            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <!-- Título de la noticia -->
                <h3 class="text-xl font-bold text-gray-800">{{ $noticia->titulo }}</h3>
                
                <!-- Descripción de la noticia (limitada a 100 caracteres) -->
                <p class="text-gray-600">{{ Str::limit($noticia->descripcion, 100) }}</p>
                
                <!-- Imagen de la noticia -->
                <img src="{{ Storage::url($noticia->imagen) }}" alt="Imagen de noticia" class="mt-2 w-48 h-auto">

                <!-- Enlace para leer más sobre la noticia -->
                <a href="{{ route('noticias.show', $noticia->id) }}" class="text-blue-600 hover:text-blue-800">Leer más</a> 

                {{-- Función de dar like o quitarlo --}}
                <div class="flex space-x-4">
                    @auth <!-- Si el usuario está autenticado -->
                        @if($noticia->users->contains(Auth::user()->id))
                            <form action="{{ route('noticias.unlike', $noticia->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full py-3 px-6 border bg-red-500 text-white rounded mt-4 hover:bg-red-600">
                                    ❌ Quitar Like
                                </button>
                            </form>
                        @else
                            <form action="{{ route('noticias.like', $noticia->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full py-3 px-6 border bg-blue-500 text-white rounded mt-4 hover:bg-blue-600">
                                    👍 Me gusta
                                </button>
                            </form>
                        @endif
                    @endauth
                    
                    <!-- Contador de likes -->
                    <div class="flex items-center space-x-2 mt-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21l-1-1c-5.67-5.69-8-8.49-8-12.36C3 4.4 4.79 2 6.88 2c1.69 0 3.32.81 4.12 2.23C11.3 4.81 12 6 12 6s.7-1.19 1-1.77C14.8 2.81 16.43 2 18.12 2 20.21 2 22 4.4 22 7.64c0 3.87-2.33 6.67-8 12.36l-1 1z" />
                        </svg>
                        <span class="text-gray-700 font-medium">{{ $noticia->users->count() }}</span>
                    </div>
                </div>
            </div>
        @endforeach
        <br>
    </div>
    <br>
    <!-- Paginación para la lista de noticias -->
    {{$noticias->links()}}
    @can('ver usuarios')
        <!-- Enlace para ver todos los lectores -->
        <div class="text-center mt-4">
            <a href="{{ route('users.show') }}" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                Ver todos los lectores
            </a>
        </div>    
    @endcan
@endsection  
