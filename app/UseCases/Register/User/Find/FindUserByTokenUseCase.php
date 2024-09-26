<?php 
namespace App\UseCases\Register\User\Find;

use App\Repositories\UserRepository;
use App\Exceptions\GeneralException;
use Carbon\Carbon;

final class FindUserByTokenUseCase {
    private UserRepository $UserRepository;

    public function __construct(UserRepository $UserRepository) {
        $this->UserRepository = $UserRepository;  
    }

    public function __invoke(String $token) {
        $result = $this->UserRepository->findByUserUnverified($token);
        return $this->validateExist($result);
    }

    public function validateExist($result) {
        if (is_null($result)) {
            return false;
        }
        return $result;
    }
    
}