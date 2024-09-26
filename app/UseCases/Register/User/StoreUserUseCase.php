<?php
namespace App\UseCases\Register\User;

use App\Repositories\UserRepository;
use App\UseCases\Mail\SendMailUseCase;
use App\Exceptions\GeneralException;
use App\Class\BaseTransaction;

final class StoreUserUseCase extends BaseTransaction {
    private UserRepository $userRepository;
    private SendMailUseCase $sendMailUseCase;

    public function __construct(UserRepository $userRepository, SendMailUseCase $sendMailUseCase){
        $this->userRepository = $userRepository;
        $this->sendMailUseCase = $sendMailUseCase;
    }
    
    public function __invoke(object $params){
        try {
            $this->userRepository->beginTransaction();        
                $result = $this->userRepository->store($params);
                $this->sendMailUseCase->__invoke(email:$result->email,
                subject:'Verificacion de cuenta',
                token:$result->verification_token);
            $this->userRepository->commitTransaction();
            return $result;

        } catch (\Illuminate\Database\QueryException $e) {
            $this->rollbackTransaction();
            throw new GeneralException($e->getMessage());
        }
        
       
    }
}