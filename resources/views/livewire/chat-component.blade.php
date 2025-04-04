<div class="p-4 bg-gray-900 text-white shadow-lg rounded-lg w-[350px]">
    <!-- Título -->
    <h2 class="text-sm font-semibold flex justify-between items-center">
        💬 Pregunta sobre las noticias
    </h2>

    <!-- Campo de texto para la pregunta -->
    <textarea wire:model="askText" 
            class="w-full mt-4 p-2 border rounded-md bg-gray-700 text-sm text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" 
            placeholder="Escribe tu pregunta aquí"></textarea>
    
    <!-- Botón de pregunta -->
    <button wire:click="submit" 
            class="mt-2 w-full py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700 transition-all">
        Preguntar
    </button>

    <!-- Respuesta -->
    @if($responseText)
        <div class="mt-4 p-2 bg-gray-800 text-white rounded-md text-sm border border-gray-600">
            <strong>📢 Respuesta:</strong>
            <p>{{ $responseText }}</p>
        </div>
    @endif
</div>