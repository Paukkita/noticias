<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Noticia; // Importa el modelo Noticia
use App\Services\GroqService;

class ChatComponent extends Component
{
    public $askText = '';
    public $responseText = '';
    protected $groqService;

    public function boot(GroqService $groqService)
    {
        $this->groqService = $groqService;
    }

    public function render()
    {
        return view('livewire.chat-component');
    }

    public function submit()
    {
        if (empty($this->askText)) {
            $this->responseText = "⚠️ Ingresa una pregunta antes de enviar.";
            return;
        }

        // Definir el contexto para la IA
        $messages = [
            ['role' => 'system', 'content' => "Eres un asistente que responde preguntas sobre noticias en la plataforma. 
            Puedes acceder a funciones del sistema como:
            - 'getMostLikedNews()' para obtener la noticia con más likes.
            - 'getLeastLikedNews()' para obtener la noticia con menos likes.
            - 'getLatestNews()' para obtener la última noticia publicada.
            - 'getNewsCount()' para contar cuántas noticias hay.
            Analiza la pregunta del usuario y responde usando una de estas funciones si es necesario."],
            ['role' => 'user', 'content' => $this->askText]
        ];

        try {
            $response = $this->groqService->chat($messages);
            $reply = $response['choices'][0]['message']['content'] ?? '❌ No se recibió respuesta.';

            // Evaluar si la IA sugiere ejecutar una función
            if (str_contains($reply, 'getMostLikedNews()')) {
                $this->responseText = $this->getMostLikedNews();
            } elseif (str_contains($reply, 'getLeastLikedNews()')) {
                $this->responseText = $this->getLeastLikedNews();
            } elseif (str_contains($reply, 'getLatestNews()')) {
                $this->responseText = $this->getLatestNews();
            } elseif (str_contains($reply, 'getNewsCount()')) {
                $this->responseText = $this->getNewsCount();
            } else {
                $this->responseText = $reply;
            }
        } catch (\Exception $e) {
            $this->responseText = '❌ Error: ' . $e->getMessage();
        }

        $this->askText = ''; // Limpiar el input después de enviar
    }

    // Obtener la noticia con más likes
    private function getMostLikedNews()
    {
        $noticia = Noticia::withCount('users')->orderByDesc('users_count')->first();

        if ($noticia) {
            return "🏆 La noticia con más likes es **'{$noticia->titulo}'** con {$noticia->users_count} likes. Puedes leer más aquí: " . route('noticias.show', $noticia->id);
        }

        return "❌ No se encontraron noticias con likes.";
    }

    // Obtener la noticia con menos likes
    private function getLeastLikedNews()
    {
        $noticia = Noticia::withCount('users')->orderBy('users_count')->first();

        if ($noticia) {
            return "❌ La noticia con menos likes es **'{$noticia->titulo}'** con {$noticia->users_count} likes. Puedes leer más aquí: " . route('noticias.show', $noticia->id);
        }

        return "❌ No se encontraron noticias con menos likes.";
    }

    // Obtener la última noticia publicada
    private function getLatestNews()
    {
        $noticia = Noticia::orderByDesc('created_at')->first();

        if ($noticia) {
            return "🆕 La última noticia publicada es **'{$noticia->titulo}'** el " . $noticia->created_at->format('d/m/Y') . ". Puedes leerla aquí: " . route('noticias.show', $noticia->id);
        }

        return "❌ No hay noticias publicadas.";
    }

    // Obtener el conteo de noticias
    private function getNewsCount()
    {
        return "📢 Actualmente hay " . Noticia::count() . " noticias publicadas.";
    }
}
