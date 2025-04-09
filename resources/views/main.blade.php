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
        <div class="mb-4  bg-blue-600 hover:bg-blue-700 w-[200px] h-[50px] py-2 px-4 rounded-md hover:border-2 hover:border-black ">
            <a href="{{ route('noticias.create.get') }}" class=" text-white  text-xl text-center font-[Poppins]">
                Crear Noticia
            </a>
        </div>
        @endcan
        <!-- Lista de Noticias -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 font-[Inter] mt-4">
            @foreach ($noticias as $noticia)
            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <h3 class="text-2xl font-bold text-gray-800 uppercase">{{ $noticia->titulo }}</h3>
                <p class="text-gray-600 break-words mt-2 mb-2">{{ Str::limit($noticia->descripcion, 100) }}</p>

                <!-- Imagen centrada -->
                <div class="flex justify-center items-center mt-4">
                    <img src="{{ Storage::url($noticia->imagen) }}" alt="Imagen de noticia" class="max-w-xs min-w-[200px] max-h-48 min-h-[150px] object-contain">
                </div>

                <br>
                <a href="{{ route('noticias.show', $noticia->id) }}" class="text-blue-600 hover:text-blue-800 text-left px-6">Leer más</a>

                <!-- Like / Unlike -->
                <div class="flex space-x-4">
                    @auth
                    <script>
                        function confirmarLike(event, form) {
                            event.preventDefault();
                            Swal.fire({
                                title: "¿Te gusta esta noticia?",
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
                            });
                        }

                        function confirmarUnlike(event, form) {
                            event.preventDefault();
                            Swal.fire({
                                title: "¿Quieres quitar el Like?",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#d33",
                                cancelButtonColor: "#3085d6",
                                confirmButtonText: "Sí",
                                cancelButtonText: "No"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    form.submit();
                                }
                            });
                        }
                    </script>

                    @if($noticia->users->contains(Auth::user()->id))
                    <form action="{{ route('noticias.unlike', $noticia->id) }}" method="POST" onsubmit="confirmarUnlike(event, this)">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-3 px-6 border bg-red-500 text-white rounded mt-4 hover:bg-red-600 font-[Poppins] hover:border-black">
                            ❌ Quitar Like
                        </button>
                    </form>
                    @else
                    <form action="{{ route('noticias.like', $noticia->id) }}" method="POST" onsubmit="confirmarLike(event, this)">
                        @csrf
                        <button type="submit" class="w-full py-3 px-6 border bg-blue-500 text-white rounded mt-4 hover:bg-blue-600 font-[Poppins] hover:border-black">
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
        </div>

        <!-- Paginación -->
        <div class="mt-4">
            {{$noticias->links()}}
        </div>
        <!-- Crear género y ver lista usuarios -->
        <div class="flex flex-col justify-center items-center space-y-4 mb-4 mx-auto">

            @can('crear genero')
            <div class="text-center bg-blue-600 hover:bg-blue-700 w-[270px] h-[auto] py-4 px-4 rounded-md">
                <button onclick="toggleForm('crear-genero-form')" class="w-full text-white text-xl font-[Poppins]">
                    Añadir Género
                </button>
                <div id="crear-genero-form" class="mt-2 hidden">
                    <form method="POST" action="{{ route('generos.store') }}" onsubmit="confirmarGenero(event, this)"  class="space-y-3" enctype="multipart/form-data">
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
                        <button type="submit"  class="w-full bg-gray-800 text-white py-1 px-3 rounded-md hover:bg-gray-700 focus:outline-none text-sm">Crear</button>
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
                                    }})};
                        </script>
                </div>
            </div>
            @endcan

            @can('ver usuarios')
            <div class="text-center bg-blue-600 hover:bg-blue-700 w-[270px] h-[auto] py-4 px-4 rounded-md">
                <a href="{{ route('users.show') }}" class="text-white text-xl text-center font-[Poppins]">
                    Ver todos los lectores
                </a>
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