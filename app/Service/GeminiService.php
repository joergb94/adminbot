<?php

namespace App\Service;

use Google\GenerativeAI\GenerativeAI;

class GeminiService
{
    protected $model;

    public function __construct()
    {
        $apiKey = env('GEMINI_API_KEY');

        $client = new GenerativeAI($apiKey);

        $this->model = $client->getGenerativeModel('gemini-1.5-flash'); 
    }

    public function ask(string $prompt): string
    {
        $result = $this->model->generateText($prompt);
        return $result->text() ?? "No pude generar una respuesta.";
    }
}
