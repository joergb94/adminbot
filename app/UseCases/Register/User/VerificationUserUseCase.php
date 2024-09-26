<?php
namespace App\UseCases\Register\User;


use App\UseCases\Mail\SendMailUseCase;
use App\UseCases\Register\User\Find\FindUserByTokenUseCase;
use App\UseCases\Register\User\Service\UpdateUserUseCase;
use App\Class\BaseTransaction;


final class VerificationUserUseCase {
    private SendMailUseCase $sendMailUseCase;
    private FindUserByTokenUseCase $findUserByTokenUseCase;
    private UpdateUserUseCase $updateUserUseCase;
    private BaseTransaction $baseTransaction;

    public function __construct(
        SendMailUseCase $sendMailUseCase,
        FindUserByTokenUseCase $findUserByTokenUseCase,
        UpdateUserUseCase $updateUserUseCase,
        BaseTransaction $baseTransaction
    ){
        $this->sendMailUseCase = $sendMailUseCase;
        $this->findUserByTokenUseCase = $findUserByTokenUseCase;
        $this->updateUserUseCase = $updateUserUseCase;
        $this->baseTransaction = $baseTransaction;

    }
    
    public function __invoke(object $params){
        $this->baseTransaction->beginTransaction();
        $user = $this->findUserByTokenUseCase->__invoke($params->token);
        if($user){
            $result = $this->updateUserUseCase->__invoke($user, ['verified' => true]);
        }else{
            return $user;
        }       
        $this->baseTransaction->commitTransaction();
        //$this->sendMailUseCase->__invoke(email:$user->email,subject:'Cuenta verificada');
        return $result;
    }
}