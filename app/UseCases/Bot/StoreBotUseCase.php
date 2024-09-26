<?php
namespace App\UseCases\Bot;

use App\Repositories\BotRepository;
use App\Exceptions\GeneralException;
use App\Class\BaseTransaction;

final class StoreBotUseCase extends BaseTransaction {
    private BotRepository $BotRepository;

    public function __construct(BotRepository $BotRepository){
        $this->BotRepository = $BotRepository;

    }
    
    public function __invoke(object $params){
        try {
            $this->BotRepository->beginTransaction();        
                $result = $this->BotRepository->store($params);
            $this->BotRepository->commitTransaction();
            return $result;

        } catch (\Illuminate\Database\QueryException $e) {
            $this->rollbackTransaction();
            throw new GeneralException($e->getMessage());
        }
        
       
    }
}