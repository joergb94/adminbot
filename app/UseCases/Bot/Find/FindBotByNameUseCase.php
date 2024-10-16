<?php 
namespace App\UseCases\Bot\Find;

use App\Http\Resources\HttpResponseExceptionApi;
use App\Repositories\BotRepository;
use App\Exceptions\GeneralException;

final class FindBotByNameUseCase {
    private BotRepository $BotRepository;

    public function __construct(BotRepository $BotRepository) {
        $this->BotRepository = $BotRepository;  
    }

    public function __invoke(String $bot_name) {
        $result = $this->BotRepository->findByName($bot_name);
        return $this->validateExist($result);
    }

    public function validateExist($result) {
        if(!is_null($result)) {
            throw new GeneralException('El nombre seleccionado ya esta en uso!');
        }
        return 'Nombre disponible.';
    }
}