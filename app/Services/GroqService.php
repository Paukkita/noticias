<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GroqService
{
    protected $apiKey;
    protected $apiUrl;

    public function __construct()
    {
        $this->apiKey = config('services.groq.api_key');
        $this->apiUrl = 'https://api.groq.com/openai/v1/chat/completions';
    }

    public function chat($messages)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type'  => 'application/json',
        ])->post($this->apiUrl, [
            'model'    => 'llama3-8b-8192',
            'messages' => $messages,
        ]);

        return $response->json();
    }
}
