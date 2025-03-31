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
    @stack('css')
</head>
<body class="bg-gray-100 text-gray-900">
    <header class="bg-gray-800 text-white p-4 flex justify-between items-center shadow-2xl">
        <h1 class="text-lg font-bold">Bienvenido a Pau Noticias</h1>
        <nav>
            <ul class="flex space-x-4">
                @auth
                @if (Auth::user()->hasRole('admin'))
                    <li> <h2 class=" text-medium"> Administrador : </h2></li>
                    <li><a href="{{ route('noticias.create.get') }}" class="hover:text-gray-400">Crear Noticia</a></li>
                    <li><a href="{{ route('noticias.edit.get','2') }}" class="hover:text-gray-400">Editar Noticia</a></li>
                    <li><a href="{{ route('users.show') }}" class="hover:text-gray-400">Ver Usuarios</a></li>
                @else 
                    <li> <h2> Usuario : </h2></li>
                @endif
                <li><a href="{{ route('main') }}" class="hover:text-gray-400">Inicio</a></li>
                <li><a href="{{ route('auth.register.get') }}" class="hover:text-gray-400">Registro</a></li>
                <li><a href="{{ route('auth.login.get') }}" class="hover:text-gray-400">Login</a></li>
                <li>
                    <!-- Si el usuario está autenticado, mostrar su nombre -->
                    <a href="{{ route('user.get', ['user' => Auth::user()->id]) }}" class="hover:text-gray-400">{{ Auth::user()->name }}</a>
                @else
                    <p> No estas loggeado</p>
                @endauth
                </li>
            </ul>
        </nav>
    </header>
    
    <main class="container my-8 p-6 mx-auto min-h-screen">
        @yield('content')
    </main>    

    <footer class="bg-gray-800 text-white text-center p-4 mt-8">
        <p>&copy; {{ date('Y') }} Noticias Pau - Todos los derechos reservados</p>
    </footer>

    @stack('js')
</body>
</html>