<form method="POST" action="{{ route('noticias.create.post') }}"  class="space-y-4" enctype="multipart/form-data">
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
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">{{ old('descripcion') }}</textarea>
    </div>

    <div>
        <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen (Opcional)</label>
        <input type="file" id="imagen" name="imagen" accept="image/*"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
    </div>

    <div>
        <label for="genero" class="block text-sm font-medium text-gray-700">Género</label>
        <select id="genero" name="genero" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            <option value="">Seleccione un género</option>
            <option value="Deportes" {{ old('genero') == 'Deportes' ? 'selected' : '' }}>Deportes</option>
            <option value="Política" {{ old('genero') == 'Política' ? 'selected' : '' }}>Política</option>
            <option value="Cultura" {{ old('genero') == 'Cultura' ? 'selected' : '' }}>Cultura</option>
            <option value="Tecnología" {{ old('genero') == 'Tecnología' ? 'selected' : '' }}>Tecnología</option>
        </select>
    </div>

    <div class="flex items-center justify-center gap-7">
        <button type="submit" class="w-[500px] bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none">
            Publicar Noticia
        </button>
        <!-- Boton para volver atrás -->
        <button onclick="window.location.href='{{ route('main') }}'" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 w-[300px]">
            Volver atrás
        </button>
    </div>
    
</form>
<br>


