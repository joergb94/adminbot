<?php
namespace App\UseCases\Bot\Find;

use App\Repositories\BotRepository;

final class FindBotAllUseCase
{
    private BotRepository $BotRepository;

    public function __construct(BotRepository $BotRepository ){
        $this->BotRepository = $BotRepository; 
    }
    
    public function __invoke(){
        return $this->BotRepository->findAll(); 
    }
}