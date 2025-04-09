<div class="p-4 bg-gray-900 text-white shadow-lg rounded-lg w-[350px]">
    <!-- Título -->
    <h2 class="text-sm font-semibold flex justify-between items-center">
        💬 Selecciona una pregunta sobre las noticias
    </h2>

    <!-- Menú desplegable para seleccionar una pregunta -->
    <select wire:model="selectedQuestion"
        class="w-full mt-4 p-2 border rounded-md bg-gray-700 text-sm text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="">Selecciona una pregunta...</option>
        <option value="most_liked">¿Cuál es la noticia con más likes?</option>
        <option value="least_liked">¿Cuál es la noticia con menos likes?</option>
        <option value="latest_news">¿Cuál es la noticia más reciente?</option>
        <option value="news_count">¿Cuántas noticias hay?</option>
    </select>

    <!-- Botón de pregunta -->
    <button wire:click="submit"
        class="mt-2 w-full py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700 transition-all">
        Preguntar
    </button>

    <!-- Historial de conversación -->
    @if(!empty($chatHistory))
    <div class="mt-4 text-sm max-h-60 overflow-y-auto space-y-2 bg-gray-800 p-3 rounded-md border border-gray-700">
        <strong class="block text-gray-300">📝 Historial de conversación:</strong>
        @foreach($chatHistory as $message)
        <div class="{{ $message['role'] === 'user' ? 'text-right' : 'text-left' }}">
            <p class="mb-4 ">
                <span class="font-semibold {{ $message['role'] === 'user' ? 'text-blue-400' : 'text-green-400' }}">
                    {{ $message['role'] === 'user' ? Auth::user()->name : 'IA' }}:
                </span>
                <br>
                <!-- Mostrar la pregunta seleccionada debajo del nombre del usuario -->
                @if($message['role'] === 'user')
                    <span class="text-gray-400 text-sm">Pregunta seleccionada: {{ $message['content'] }}</span>
                @else
                    {{ $message['content'] }}
                @endif
            </p>
        </div>
        @endforeach
    </div>
    @endif
</div>
