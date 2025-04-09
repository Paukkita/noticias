<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Noticia; // Importa el modelo Noticia
use App\Services\GroqService;

class ChatComponent extends Component
{
    public $selectedQuestion = '';
    public $responseText = '';
    public $chatHistory = [];
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
        // Verificar si se seleccionó una pregunta
        if (empty($this->selectedQuestion)) {
            $this->responseText = "⚠️ Por favor, selecciona una pregunta antes de enviar.";
            return;
        }

        // Mapa directo de las preguntas
        $questionsMap = [
            'most_liked' => '¿Cuál es la noticia con más likes?',
            'least_liked' => '¿Cuál es la noticia con menos likes?',
            'latest_news' => '¿Cuál es la noticia más reciente?',
            'news_count' => '¿Cuántas noticias hay?'
        ];

        // Obtener la pregunta seleccionada
        $questionText = $questionsMap[$this->selectedQuestion] ?? 'Pregunta no válida';

        // Respuesta según la pregunta seleccionada
        switch ($this->selectedQuestion) {
            case 'most_liked':
                $this->responseText = $this->getMostLikedNews();
                break;
            case 'least_liked':
                $this->responseText = $this->getLeastLikedNews();
                break;
            case 'latest_news':
                $this->responseText = $this->getLatestNews();
                break;
            case 'news_count':
                $this->responseText = $this->getNewsCount();
                break;
            default:
                $this->responseText = "❌ No pude entender tu pregunta, intenta con una opción válida.";
        }

        // Agregar la pregunta y la respuesta de la IA al historial
        $this->chatHistory[] = ['role' => 'user', 'content' => $questionText];
        $this->chatHistory[] = ['role' => 'IA', 'content' => $this->responseText];

        // Limpiar la selección de pregunta para permitir nuevas preguntas
        $this->selectedQuestion = '';
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
