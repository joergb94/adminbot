<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Service\MessageHandler;
use App\UseCases\Bot\Find\FindBotByTokenUseCase;

class TelegramWebHookController extends Controller
{
    private FindBotByTokenUseCase $findBotByTokenUseCase;

    public function __construct(FindBotByTokenUseCase $findBotByTokenUseCase)
    {
        $this->findBotByTokenUseCase = $findBotByTokenUseCase;
    }

    public function __invoke(Request $request, string $token)
    {
        // Obtener el update
        $update = Telegram::getWebhookUpdate(); 

        // Instanciar handler pasando el token y el UseCase
        $handler = new MessageHandler($token, $this->findBotByTokenUseCase);
        $handler->handle($update);

        return response('ok', 200);
    }
}
