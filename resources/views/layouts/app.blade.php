<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Noticias Pau</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- <link rel="stylesheet" href="/tutorial/blog/resources/css/app.css"> --}}
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
    {{--  @stack('css') --}}
    <script type="text/javascript" src="{{ asset('js/app.js') }}" defer> </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Importar Poppins desde Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

</head>
<body class="bg-gray-100 text-gray-900">
    <header class="bg-gray-800 text-white p-4 flex justify-between items-center shadow-2xl">
        <h1 class="text-lg font-bold flex items-center">
            <img src="{{ asset('logo_oso.png') }}" alt="Logo Oso" class="w-16 h-16">
            <h1 class="ml-2 mt-2 text-4xl font-bold text-center font-[Roboto] mb-4">
                Noticias
            </h1>
        </h1>
        
        <nav>
            <ul class="flex space-x-4">
                @auth
                @if (Auth::user()->hasRole('admin'))
                    <li><h2 class="text-medium">Administrador:</h2></li>
                    <li><a href="{{ route('noticias.create.get') }}" class="hover:text-gray-400 hover:border-b-2 border-white">Crear Noticia</a></li>
                    <li><a href="{{ route('noticias.edit.get','2') }}" class="hover:text-gray-400 hover:border-b-2 border-white">Editar Noticia</a></li>
                    <li><a href="{{ route('users.show') }}" class="hover:text-gray-400 hover:border-b-2 border-white">Ver Usuarios</a></li>
                    <li><a href="{{ route('auth.register.get') }}" class="hover:text-gray-400 hover:border-b-2 border-white">Registro</a></li>
                    <li><a href="{{ route('auth.login.get') }}" class="hover:text-gray-400 hover:border-b-2 border-white">Login</a></li>
                @else
                    <li><h2>Usuario:</h2></li>
                @endif
                <li><a href="{{ route('main') }}" class="hover:text-gray-400 hover:border-b-2 border-white">Inicio</a></li>
                <li>
                    <!-- Si el usuario está autenticado, mostrar su nombre -->
                    <a href="{{ route('user.get', ['user' => Auth::user()->id]) }}" class="hover:text-gray-400 hover:border-b-2 border-white">{{ Auth::user()->name }}</a>
                @else
                    <p>No estás logueado</p>
                @endauth
                </li>
            </ul>
        </nav>
        
    </header>
    
    <main class="h-full w-full min-h-screen">
        @yield('content')
    </main>
    

    <footer class="bg-gray-800 text-white text-center p-4 ">
        <p>&copy; {{ date('Y') }} Noticias Pau - Todos los derechos reservados</p>
    </footer>

    {{-- @stack('js') --}}
    <x-toaster-hub />
</body>
</html>