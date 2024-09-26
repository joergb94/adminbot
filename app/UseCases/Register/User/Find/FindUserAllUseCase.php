<?php
namespace App\UseCases\Register\User\Find;

use App\Repositories\UserRepository;

final class FindUserAllUseCase
{
    private UserRepository $UserRepository;

    public function __construct(UserRepository $UserRepository ){
        $this->UserRepository = $UserRepository; 
    }
    
    public function __invoke(){
        return $this->UserRepository->findAll(); 
    }
}