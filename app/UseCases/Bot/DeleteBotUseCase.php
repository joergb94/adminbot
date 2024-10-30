<?php 
namespace App\UseCases\Bot;

use App\Repositories\BotRepository;
use App\UseCases\Bot\Find\FindBotByIdUseCase;

final class DeleteBotUseCase {
    private BotRepository $BotRepository;
    private FindBotByIdUseCase $findBotByIdUseCase;

    public function __construct(BotRepository $BotRepository, FindBotByIdUseCase $findBotByIdUseCase)
    {
        $this->BotRepository      = $BotRepository; 
        $this->findBotByIdUseCase = $findBotByIdUseCase;
    }

    public function __invoke(int $id)
    {
        $Bot = $this->findBotByIdUseCase->__invoke($id);
        $this->BotRepository->beginTransaction();
        $result = $this->BotRepository->deleted($Bot);
        $this->BotRepository->commitTransaction();
        return $result;
    }
}