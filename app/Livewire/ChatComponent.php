<?php

namespace App\Livewire;

use App\Models\ChatHistory;
use Livewire\Component;
use App\Models\Noticia;
use App\Services\GroqService;
use Illuminate\Support\Facades\Auth;

class ChatComponent extends Component
{
    public $selectedQuestion = '';
    public $responseText = '';
    public $chatHistory = [];
    protected $groqService;

    public function boot(GroqService $groqService)
    {
        $this->groqService = $groqService;
        $this->loadChatHistory();
    }

    public function render()
    {
        return view('livewire.chat-component');
    }

    public function submit()
    {
        if (empty($this->selectedQuestion)) {
            $this->responseText = "⚠️ Por favor, selecciona una pregunta antes de enviar.";
            return;
        }

        $questionsMap = [
            'most_liked' => '¿Cuál es la noticia con más likes?',
            'least_liked' => '¿Cuál es la noticia con menos likes?',
            'latest_news' => '¿Cuál es la noticia más reciente?',
            'news_count' => '¿Cuántas noticias hay?'
        ];

        $questionText = $questionsMap[$this->selectedQuestion] ?? 'Pregunta no válida';

        // Guardar pregunta del usuario primero
        $this->saveMessage($questionText, 'user');

        switch ($this->selectedQuestion) {
            case 'most_liked':
                $response = $this->getMostLikedNews();
                break;
            case 'least_liked':
                $response = $this->getLeastLikedNews();
                break;
            case 'latest_news':
                $response = $this->getLatestNews();
                break;
            case 'news_count':
                $response = $this->getNewsCount();
                break;
            default:
                $response = "❌ No pude entender tu pregunta, intenta con una opción válida.";
        }

        $this->responseText = $response;
        $this->saveMessage($response, 'IA');

        $this->selectedQuestion = '';
        $this->loadChatHistory();
    }

    private function getMostLikedNews()
    {
        $noticia = Noticia::withCount('users')->orderByDesc('users_count')->first();

        return $noticia
            ? "🏆 La noticia con más likes es '{$noticia->titulo}' con {$noticia->users_count} likes. Puedes leer más aquí: " . route('noticias.show', $noticia->id)
            : "❌ No se encontraron noticias con likes.";
    }

    private function getLeastLikedNews()
    {
        $noticia = Noticia::withCount('users')->orderBy('users_count')->first();

        return $noticia
            ? "📉 La noticia con menos likes es '{$noticia->titulo}' con {$noticia->users_count} likes. Puedes leer más aquí: " . route('noticias.show', $noticia->id)
            : "❌ No se encontraron noticias con menos likes.";
    }

    private function getLatestNews()
    {
        $noticia = Noticia::orderByDesc('created_at')->first();

        return $noticia
            ? "🆕 La última noticia publicada es '{$noticia->titulo}' el " . $noticia->created_at->format('d/m/Y') . ". Puedes leerla aquí: " . route('noticias.show', $noticia->id)
            : "❌ No hay noticias publicadas.";
    }

    private function getNewsCount()
    {
        $count = Noticia::count();
        return "📢 Actualmente hay " . $count . " noticias publicadas.";
    }

    private function loadChatHistory()
    {
        $this->chatHistory = ChatHistory::where('user_id', Auth::id())
            ->orderBy('created_at', 'asc')
            ->limit(20)
            ->get()
            ->map(function ($item) {
                return [
                    'role' => $item->role,
                    'content' => $item->content
                ];
            })
            ->toArray();
    }

    private function saveMessage($content, $role)
    {
        ChatHistory::create([
            'user_id' => Auth::id(),
            'role' => $role,
            'content' => $content,
        ]);
    }

    public function clearHistory()
    {
        ChatHistory::where('user_id', Auth::id())->delete();
        $this->chatHistory = [];
        $this->responseText = '';
    }
}