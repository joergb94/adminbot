<?php 
namespace App\UseCases\Bot\Find;

use App\Http\Resources\HttpResponseExceptionApi;
use App\Repositories\BotRepository;
use App\Repositories\FlowRepository;
use App\Exceptions\GeneralException;

final class FindBotByTokenUseCase {
    private BotRepository $BotRepository;
    private FlowRepository $flowRepository;

    public function __construct(BotRepository $BotRepository, FlowRepository $flowRepository) {
        $this->BotRepository = $BotRepository;
        $this->flowRepository = $flowRepository;
    }

    public function __invoke(String $bot_token, String $command) {
        
        $case = null;
        $flow = null;

        $result = $this->BotRepository->findByToken($bot_token);
        if(isset($result)){

           $flow = $this->flowRepository->findByBotAndName($command,$result->id);

           $case['bot'] =$result;
           $case['flow']= $flow;

        }

        

        return $this->validateExist($case);
    }

    public function validateExist($result) {
        if(is_null($result)) {
            return [];
        }
        return $result;
    }
}