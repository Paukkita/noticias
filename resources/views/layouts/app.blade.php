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
    {{-- @stack('css') --}}
    <!--  <script type="text/javascript" src="{{ asset('js/app.js') }}" defer> </script>  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Tipografias-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-900">
    <header class="bg-gray-800 text-white p-4 flex justify-between items-center shadow-2xl">
        <h1 class="text-lg font-bold flex items-center">
            <img src="{{ asset('logo_oso.png') }}" alt="Logo Oso" class="w-16 h-16">
        </h1>

        <nav>
            <ul class="flex space-x-8 text-xl">
                @auth
                @if (Auth::user()->hasRole('admin'))
                <li>
                    <h2 class="text-medium">Administrador:</h2>
                </li>
                <li><a href="{{ route('noticias.create.get') }}" class="hover:text-gray-400 hover:border-b-2 border-white">Crear Noticia</a></li>
                <li><a href="{{ route('users.show') }}" class="hover:text-gray-400 hover:border-b-2 border-white">Ver Usuarios</a></li>
                <li><a href="{{ route('auth.register.get') }}" class="hover:text-gray-400 hover:border-b-2 border-white">Registro</a></li>
                <li><a href="{{ route('auth.login.get') }}" class="hover:text-gray-400 hover:border-b-2 border-white">Login</a></li>
                @endif
                <li><a href="{{ route('main') }}" class="hover:text-gray-400 hover:border-b-2 border-white">Inicio</a></li>
                <li class="flex flex-col items-end">
                    @auth
                    <p class="hover:text-gray-400 hover:border-b-2 border-white">
                        <a href="{{ route('user.get', Auth::user()->id) }}" class="hover:text-gray-400 hover:border-b-2 border-white">
                            {{ Auth::user()->name }}
                        </a>
                    </p>
                    @endauth
                </li>
                <li class="flex justify-end">
                    <form action="{{ route('auth.login.get') }}" method="GET" onsubmit="cerrarSesion(this)">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 font-[Poppins] hover:border-black text-sm">
                            ❌ Cerrar sesión
                        </button>
                    </form>
                </li>
                @endauth
            </ul>

            <script>
                function cerrarSesion(form) {
                    event.preventDefault();
                    Swal.fire({
                        title: "¿Quieres cerrar sesión?",
                        icon: "warning",
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
            </script>
        </nav>
    </header>

    <main class="h-full w-full min-h-screen">
        @yield('content')
        @include('sweetalert::alert')
    </main>


    <footer class="bg-gray-800 text-white text-center p-4 ">
        <p>&copy; {{ date('Y') }} Noticias Pau - Todos los derechos reservados</p>
    </footer>

    {{-- @stack('js') --}}
</body>

</html>