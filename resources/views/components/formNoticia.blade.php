@props(['generos'])

<div class="p-8">

    <form method="POST" action="{{ route('noticias.create.post') }}" class="space-y-4" enctype="multipart/form-data">
        @csrf
        <h2 class="text-2xl font-bold mb-4 text-center"> Crear una noticia</h2>
        @if ($errors->any())
        <div class="p-4 bg-red-100 text-red-700 rounded">
            <h2 class="font-bold">Errores</h2>
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div>
            <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
            <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="fecha_publicacion" class="block text-sm font-medium text-gray-700">Fecha de Publicación</label>
            <input type="date" id="fecha_publicacion" name="fecha_publicacion" value="{{ old('fecha_publicacion', date('Y-m-d')) }}"
                min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="4"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                oninput="actualizarContador()" maxlength="255">{{ old('descripcion') }}</textarea>
            <p id="contadorCaracteres" class="text-sm text-gray-500 mt-2">0/255 caracteres</p>
        </div>

        <script>
            // Función para actualizar el contador de caracteres
            function actualizarContador() {
                const textarea = document.getElementById('descripcion');
                const contador = document.getElementById('contadorCaracteres');
                const longitudActual = textarea.value.length;
                const longitudMaxima = textarea.getAttribute('maxlength');
                contador.textContent = `${longitudActual}/${longitudMaxima} caracteres`;
            }
        </script>


        <div>
            <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen</label>
            <input type="file" id="imagen" name="imagen" required accept="image/*"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="genero_id" class="block text-sm font-medium text-gray-700">Género</label>
            <select name="genero_id" id="genero_id">
                <option value="">Seleccione un género</option>
                @foreach ($generos as $genero)
                <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center justify-center">
            <button type="submit" class="w-[500px] bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none">
                Publicar Noticia
            </button>
        </div>
    </form>
    <div class="flex items-center justify-center mt-4 ">
        <!-- Boton para volver atrás -->
        <button onclick="window.history.back()" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 w-[500px]">
            Volver atrás
        </button>

    </div>