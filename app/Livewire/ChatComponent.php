<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Noticia;
use App\Models\ChatHistory;
use App\Services\GroqService;
use Illuminate\Support\Facades\Auth;

class ChatComponent extends Component
{
    public $askText = '';
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
            $this->responseText = "⚠️ Por favor selecciona una pregunta de la lista.";
            return;
        }
    
        // Mapeamos las preguntas a las funciones
        $questionToFunction = [
            'most_liked' => [
                'function' => 'getMostLikedNews()',
                'description' => 'Obtener la noticia más popular'
            ],
            'least_liked' => [
                'function' => 'getLeastLikedNews()',
                'description' => 'Obtener la noticia menos popular'
            ],
            'latest_news' => [
                'function' => 'getLatestNews()',
                'description' => 'Obtener las últimas noticias'
            ],
            'news_count' => [
                'function' => 'getNewsCount()',
                'description' => 'Obtener el número total de noticias'
            ]
        ];
    
        $selected = $questionToFunction[$this->selectedQuestion] ?? null;
        
        if (!$selected) {
            $this->responseText = "⚠️ Pregunta no reconocida.";
            return;
        }
    
        $this->askText = $selected['description']; // Usamos la descripción como input más natural
        $this->saveMessage($this->askText, 'user');
    
        // Obtenemos primero los datos crudos
        try {
            $rawData = '';
            switch ($this->selectedQuestion) {
                case 'most_liked':
                    $rawData = $this->getMostLikedNews();
                    break;
                case 'least_liked':
                    $rawData = $this->getLeastLikedNews();
                    break;
                case 'latest_news':
                    $rawData = $this->getLatestNews();
                    break;
                case 'news_count':
                    $rawData = $this->getNewsCount();
                    break;
            }
    
            // Preparamos el contexto para Groq
            $messages = [
                ['role' => 'system', 'content' => "Eres un asistente de noticias. Te proporcionaré datos crudos y los enriquecerás con un formato amigable. Responde de manera natural pero profesional."],
                ['role' => 'user', 'content' => "Pregunta: {$selected['description']}\nDatos crudos:\n{$rawData}\n\nPor favor, formatea esta respuesta de manera clara y agradable, añadiendo contexto útil si es necesario."]
            ];
    
            // Obtenemos respuesta enriquecida de Groq
            $response = $this->groqService->chat($messages);
            $this->responseText = $response['choices'][0]['message']['content'] ?? $rawData;
    
            // Si Groq falla, mostramos los datos crudos con un formato básico
            if ($this->responseText === $rawData) {
                $this->responseText = $this->formatFallbackResponse($this->selectedQuestion, $rawData);
            }
    
            $this->saveMessage($this->responseText, 'IA');
    
        } catch (\Exception $e) {
            $this->responseText = '❌ Error: ' . $e->getMessage();
        }
    
        $this->askText = '';
        $this->selectedQuestion = '';
        $this->loadChatHistory();
    }
    
    // Método auxiliar para formatear respuestas cuando Groq falla
    protected function formatFallbackResponse(string $questionType, string $rawData): string
    {
        switch ($questionType) {
            case 'most_liked':
                return "📌 La noticia más popular es:\n\n{$rawData}";
            case 'least_liked':
                return "📌 La noticia menos popular es:\n\n{$rawData}";
            case 'latest_news':
                return "📰 Últimas noticias:\n\n{$rawData}";
            case 'news_count':
                return "🔢 Total de noticias en el sistema: {$rawData}";
            default:
                return $rawData;
        }
    }

    private function getMostLikedNews()
    {
        $noticia = Noticia::withCount('users')->orderByDesc('users_count')->first();

        if ($noticia) {
            return "🏆 La noticia con más likes es **'{$noticia->titulo}'** con {$noticia->users_count} likes. Puedes leer más aquí: " . route('noticias.show', $noticia->id);
        }

        return "❌ No se encontraron noticias con likes.";
    }

    private function getLeastLikedNews()
    {
        $noticia = Noticia::withCount('users')->orderBy('users_count')->first();

        if ($noticia) {
            return "📉 La noticia con menos likes es **'{$noticia->titulo}'** con {$noticia->users_count} likes. Puedes leer más aquí: " . route('noticias.show', $noticia->id);
        }

        return "❌ No se encontraron noticias con menos likes.";
    }

    private function getLatestNews()
    {
        $noticia = Noticia::orderByDesc('created_at')->first();

        if ($noticia) {
            return "🆕 La última noticia publicada es **'{$noticia->titulo}'** el " . $noticia->created_at->format('d/m/Y') . ". Puedes leerla aquí: " . route('noticias.show', $noticia->id);
        }

        return "❌ No hay noticias publicadas.";
    }

    private function getNewsCount()
    {
        $count = Noticia::count();
        return "📢 Actualmente hay **{$count}** noticias publicadas.";
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

    /*************  ✨ Windsurf Command ⭐  *************/
    /**
     * Borra el historial de chat del usuario actual y resetea las variables
     * $chatHistory y $responseText.
     *
     * @return void
     */
    /*******  c6963642-288c-43f2-893a-d158afa4c0dc  *******/
    public function clearHistory()
    {
        ChatHistory::where('user_id', Auth::id())->delete();
        $this->chatHistory = [];
        $this->responseText = '';
    }
}
