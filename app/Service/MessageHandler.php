<?php

namespace App\Service;

use Telegram\Bot\Api;
use App\UseCases\Bot\Find\FindBotByTokenUseCase;
use Illuminate\Support\Facades\Log;

class MessageHandler
{
    protected string $bot_token;
    protected FindBotByTokenUseCase $findBotByTokenUseCase;

    public function __construct(string $bot_token, FindBotByTokenUseCase $findBotByTokenUseCase)
    {
        $this->bot_token = $bot_token;
        $this->findBotByTokenUseCase = $findBotByTokenUseCase;
    }

    public function handle($update)
    {
        try {
            $message = $update->getMessage();
            if (!$message) {
                Log::info("Update recibido sin mensaje: " . json_encode($update));
                return;
            }

            $chat = $message->getChat();
            $chatId = $chat->getId();
            $chatType = $chat->getType(); // private, group, supergroup
            $text = $message->getText();

            Log::info("Mensaje recibido", [
                'chat_id' => $chatId,
                'chat_type' => $chatType,
                'text' => $text,
                'bot_token' => $this->bot_token
            ]);

            // Obtener info del bot y flujos
            $dataBot = $this->findBotByTokenUseCase->__invoke($this->bot_token, $text);
            Log::info("Data del bot obtenida", ['dataBot' => $dataBot]);

            // Construir respuesta según tipo de chat
            $reply = $this->buildReply($chatType, $dataBot);

            // Crear instancia de bot con token dinámico
            $bot = new Api($this->bot_token);
            $bot->sendMessage([
                'chat_id' => $chatId,
                'text' => $reply
            ]);

            Log::info("Respuesta enviada", [
                'chat_id' => $chatId,
                'reply' => $reply
            ]);

        } catch (\Exception $e) {
            Log::error("Error en MessageHandler: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    private function buildReply(string $chatType, array $dataBot): string
    {
        if (isset($dataBot['flow']['name'])) {
            $flow = $dataBot['flow']['name'];
            $request = $dataBot['flow']['description'] ?? '';
            return "Seleccionaste la opción: $flow 👋, $request";
        }

        $name = $dataBot['bot']['name'] ?? 'Bot';
        $description = $dataBot['bot']['description'] ?? '';
        $template = $chatType === 'private' ? "Hola soy" : "Hola grupo soy";

        return "$template $name 👋, $description";
    }
}
