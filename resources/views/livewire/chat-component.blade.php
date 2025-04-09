<div class="p-4 bg-gray-900 text-white shadow-lg rounded-lg w-[350px]">
    <!-- Título -->
    <h2 class="text-sm font-semibold mb-2">💬 Pregunta sobre las noticias</h2>

    <!-- Selector de preguntas -->
    <select wire:model="selectedQuestion" 
            class="w-full p-2 border rounded-md bg-gray-700 text-sm text-white mb-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="">-- Selecciona una pregunta --</option>
        <option value="most_liked">Noticia con más likes</option>
        <option value="least_liked">Noticia con menos likes</option>
        <option value="latest_news">Última noticia</option>
        <option value="news_count">Cantidad de noticias</option>
    </select>

    <!-- Botón para preguntar -->
    <button wire:click="submit"
            class="w-full py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700 transition-all"
            wire:loading.attr="disabled">
        <span wire:loading.remove>Preguntar</span>
        <span wire:loading>
            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Procesando...
        </span>
    </button>

    <!-- Respuesta -->
    @if($responseText)
    <div class="mt-4 p-3 bg-gray-800 rounded-md text-sm border border-gray-600">
        <strong class="block text-blue-400 mb-1">Respuesta:</strong>
        <p>{{ $responseText }}</p>
    </div>
    @endif

    <!-- Historial -->
    <div class="mt-4 p-2 bg-gray-800 rounded-md text-sm border border-gray-600 max-h-[500px] overflow-y-auto space-y-2">
        <div class="flex justify-between items-center mb-2">
            <strong class="text-blue-400">💬 Historial:</strong>
            <button wire:click="clearHistory" 
                    class="text-xs bg-red-600 hover:bg-red-700 px-2 py-1 rounded"
                    title="Limpiar historial">
                🗑️ Limpiar
            </button>
        </div>
        
        @if(count($chatHistory) > 0)
            @foreach($chatHistory as $message)
            <div class="@if($message['role'] === 'user') text-right @else text-left @endif">
                <div class="inline-block px-3 py-2 rounded-lg 
                        @if($message['role'] === 'user') bg-blue-600 @else bg-gray-700 @endif">
                    <strong class="block text-xs opacity-70">
                        @if($message['role'] === 'user')
                            Tú
                        @else
                            Asistente
                        @endif
                    </strong>
                    <span class="block mt-1">{{ $message['content'] }}</span>
                </div>
            </div>
            @endforeach
        @else
            <div class="text-center text-gray-400 py-4">
                No hay mensajes aún. ¡Haz una pregunta!
            </div>
        @endif
    </div>
</div>