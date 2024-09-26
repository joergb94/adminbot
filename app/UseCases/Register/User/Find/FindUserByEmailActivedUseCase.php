<?php 
namespace App\UseCases\Register\User\Find;

use App\Repositories\UserRepository;


final class FindUserByEmailActivedUseCase {
    private UserRepository $UserRepository;

    public function __construct(UserRepository $UserRepository) {
        $this->UserRepository = $UserRepository;  
    }

    public function __invoke(String $email) {
        $result = $this->UserRepository->findByEmail($email);
        return $this->validateExist($result);
    }

    
    public function validateExist($result) {
            if(!is_null($result) && $result->verified == false){
                return false;
            }

            return $result;
    }


    
}