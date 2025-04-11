@extends('layouts.app')

@section('content')
<div class="flex h-screen ">
    <!-- Barra lateral siempre visible en estado colapsado -->
    <aside id="mySidebar" class="bg-gray-800 h-full text-white w-16 px-2 py-7 transition-all duration-300 overflow-hidden">
        <!-- Botón siempre visible dentro del sidebar -->
        <button id="toggle-sidebar" class=" bg-teal-600 text-white p-2 rounded-md z-50" onclick="toggleSidebar()">&#9776;</button>
        <br> <br>
        <!-- Contenido de la barra lateral (Oculto inicialmente) -->
        <div id="sidebar-content" class="hidden opacity-0 transition-opacity duration-300">
            <livewire:chat-component />
        </div>
    </aside>

    <!-- Contenido principal -->
    <article class="flex-1 py-6 px-24 overflow-y-auto" id="main">
        <!-- Botón para crear una noticia, visible solo si el usuario tiene permiso -->
        @can('crear noticias')
        <div class="mb-4 w-[200px] h-[50px]">
            <a href="{{ route('noticias.create.get') }}"
                class="flex items-center justify-center w-full h-full bg-blue-600 hover:bg-blue-700 
                text-white text-xl font-[Poppins] rounded-md transition-all duration-200
                hover:shadow-md hover:translate-y-[-2px] border-2 border-transparent 
                hover:border-blue-400">
                Crear Noticia
            </a>
        </div>
        @endcan

        <!-- Noticias -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @foreach ($noticias as $noticia)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <!-- Contenido de la noticia -->
                <div class="p-5">
                    <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold mb-2">
                        {{$noticia->genero->genero}}
                    </span>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $noticia->titulo }}</h3>
                    <div class="h-[80px]">
                        <p class="text-gray-600 mb-4 break-words overflow-hidden">
                            {{ Str::limit($noticia->descripcion, 100) }}
                        </p>
                    </div>
                    <!-- Imagen -->
                    <div class="h-[300px] mb-4 rounded-lg overflow-hidden">
                        <img src="{{ Storage::url($noticia->imagen) }}" alt="Imagen de noticia"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    </div>

                    <!-- Acciones -->
                    <div class="flex items-center justify-between border-t pt-4">
                        <a href="{{ route('noticias.show', $noticia->id) }}"
                            class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                            Leer más
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>

                        <!-- Like Section -->
                        <div class="flex items-center space-x-2">
                            @auth
                            @if($noticia->users->contains(Auth::user()->id))
                            <form action="{{ route('noticias.unlike', $noticia->id) }}" method="POST" onsubmit="confirmarUnlike(event, this)">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                            @else
                            <form action="{{ route('noticias.like', $noticia->id) }}" method="POST" onsubmit="confirmarLike(event, this)">
                                @csrf
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                            </form>
                            @endif
                            @endauth

                            <span class="text-gray-700 font-medium">{{ $noticia->users->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Paginación -->
        <div class="mt-4">
            {{$noticias->links()}}
        </div>
        <!-- Crear género y ver lista usuarios -->
        <div class="flex flex-col justify-center items-center space-y-4 mb-4 mx-auto">

            @can('ver usuarios')
            <div class=" mt-4 text-center bg-blue-600 hover:bg-blue-700 w-[270px] h-[auto] py-4 px-4 rounded-md">
                <a href="{{ route('users.show') }}" class="text-white text-xl text-center font-[Poppins]">
                    Ver todos los lectores
                </a>
            </div>
            @endcan

            @can('crear genero')
            <div class="text-center bg-blue-600 hover:bg-blue-700 w-[270px] h-[auto] py-4 px-4 rounded-md 
            transition-colors duration-300 ease-in-out 
            hover:shadow-lg hover:border-b-4 hover:border-blue-500">
                <button onclick="toggleForm('crear-genero-form')" class="w-full text-white text-xl font-[Poppins] ">
                    Añadir Género
                </button>
                <div id="crear-genero-form" class="mt-2 hidden">
                    <form method="POST" action="{{ route('generos.store') }}" onsubmit="confirmarGenero(event, this)" class="space-y-3" enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                        <div class="p-3 bg-red-100 text-red-700 rounded-md text-sm">
                            <h2 class="font-semibold">Errores</h2>
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <input type="text" id="genero" name="genero" class="w-full px-2 py-1 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <button type="submit" class="w-full bg-gray-800 text-white py-1 px-3 rounded-md hover:bg-gray-700 focus:outline-none text-sm">Crear</button>
                    </form>
                    <script>
                        function confirmarGenero(event, form) {
                            event.preventDefault();
                            Swal.fire({
                                title: "¿Estas seguro de crear el género?",
                                icon: "question",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Sí",
                                cancelButtonText: "No"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    form.submit();
                                }
                            })
                        };
                    </script>
                </div>
            </div>
            @endcan

        </div>
    </article>
</div>

<!-- Script para expandir/contraer la barra lateral -->
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById("mySidebar");
        const content = document.getElementById("sidebar-content");

        if (sidebar.classList.contains("w-96")) {
            // Contrae el sidebar
            sidebar.classList.remove("w-96");
            sidebar.classList.add("w-16");
            content.classList.add("opacity-0");
            setTimeout(() => content.classList.add("hidden")); // Oculta después de la animación
        } else {
            // Expande el sidebar
            sidebar.classList.remove("w-16");
            sidebar.classList.add("w-96");
            content.classList.remove("hidden");
            setTimeout(() => content.classList.add("opacity-100"), 100);
        }
    }

    function toggleForm(formId) {
        const form = document.getElementById(formId);
        if (form.classList.contains('hidden')) {
            form.classList.remove('hidden');
            form.classList.add('block');
        } else {
            form.classList.remove('block');
            form.classList.add('hidden');
        }
    }
</script>

@endsection