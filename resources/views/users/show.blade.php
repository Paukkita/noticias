@extends('layouts.app')

@section('content')
    <!-- Contenedor principal para los detalles de los usuarios -->
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4 font-[Roboto]">Detalles de los Usuarios</h2>  <!-- Título principal -->
        <input type="text" id="busqueda" placeholder="Busca por nombre" class="border-2 border-gray-300 p-2">
        <button id="botonBuscar" class="bg-blue-500 text-white p-2 font-[Poppins]">Buscar</button>
        <br><br>
        <!-- Sección para mostrar la lista de usuarios -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg border border-gray-300 font-[Inter]">
                <thead>
                    <tr class="bg-gray-100 border-b border-gray-300">
                        <th class="py-3 px-6 text-left text-gray-700">Nombre</th>
                        <th class="py-3 px-6 text-left text-gray-700">Email</th>
                        <th class="py-3 px-6 text-left text-gray-700">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Recorremos todos los usuarios que se pasan desde el controlador -->
                    @foreach ($users as $user)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <!-- Nombre del usuario -->
                            <td class="py-4 px-6 text-gray-700">{{ $user->name }}</td>
            
                            <!-- Correo electrónico del usuario -->
                            <td class="py-4 px-6 text-gray-700">{{ $user->email }}</td>
            
                            <!-- Acciones (Editar y Eliminar) -->
                            <td class="py-4 px-6">
                                <!-- Enlace para editar los detalles de cada usuario -->
                                <a href="{{ route('users.get', ['user' => $user->id]) }}" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 mr-2 font-[Poppins]">
                                    Editar
                                </a>
                                <script>
                                    function confirmarEliminar(form) {
                                        event.preventDefault();
                                        Swal.fire({
                                            title: "¿Estás seguro de eliminar este usuario?",
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#d33",
                                            cancelButtonColor: "#3085d6",
                                            confirmButtonText: "Sí, eliminar",
                                            cancelButtonText: "No, cancelar"
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                form.submit();
                                            }
                                        });
                                    }
                                </script>
                                
                                <!-- Formulario para eliminar un usuario -->
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="confirmarEliminar(this)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 font-[Poppins]">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>    
        </div>

        <div class="flex gap-8 mt-4">
            <!-- Formulario para redirigir al registro de nuevos usuarios -->
            <form action="{{ route('auth.register.get') }}" method="get">
                    <!-- Botón para registrar nuevos usuarios -->
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 mt-2 font-[Poppins] h-[50px] w-[200px]">
                    Regístrar usuarios
                </button>
            </form>
            <!-- Boton para volver atrás -->
            <button onclick="window.history.back()" class="bg-blue-600 mt-2 w-[200px] text-white py-2 px-4 rounded-md hover:bg-blue-700 font-[Poppins] h-[50px]">
                Volver atrás
            </button>
        </div>
    </div>

    <script>
        document.getElementById('botonBuscar').addEventListener('click', function() {
        let busqueda = document.getElementById('busqueda').value.toLowerCase();
        let filas = document.querySelectorAll('table tbody tr');
    
        filas.forEach(fila => {
            let textoFila = fila.textContent.toLowerCase();
            if (textoFila.includes(busqueda)) {
                fila.style.display = '';
            } else {
                fila.style.display = 'none';
            }
        });
    });
    </script>
@endsection
