<?php 
namespace App\UseCases\Bot\Service;

use App\Repositories\BotRepository;
use App\Models\Bot;

final class UpdateBotUseCase {
    private BotRepository $BotRepository;

    public function __construct(BotRepository $BotRepository)
    {
        $this->BotRepository = $BotRepository; 
    }

    public function __invoke(Bot $Bot, array $params)
    {
        return $this->BotRepository->update($Bot, $params);
    }
}