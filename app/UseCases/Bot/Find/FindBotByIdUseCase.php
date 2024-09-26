<?php 
namespace App\UseCases\Bot\Find;

use App\Http\Resources\HttpResponseExceptionApi;
use App\Repositories\BotRepository;
use App\Exceptions\GeneralException;

final class FindBotByIdUseCase {
    private BotRepository $BotRepository;

    public function __construct(BotRepository $BotRepository) {
        $this->BotRepository = $BotRepository;  
    }

    public function __invoke(int $BotId) {
        $result = $this->BotRepository->findById($BotId);
        return $this->validateExist($result);
    }

    public function validateExist($result) {
        if(is_null($result)) {
            throw new GeneralException('El Bot seleccionado por ID no existe!');
        }
        return $result;
    }
}