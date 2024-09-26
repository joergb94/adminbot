<?php 
namespace App\UseCases\Register\User;

use App\Repositories\UserRepository;
use App\UseCases\Register\User\Find\FindUserByIdUseCase;

final class UpdateUserUseCase {
    private UserRepository $UserRepository;
    private FindUserByIdUseCase $findUserByIdUseCase;

    public function __construct(UserRepository $UserRepository, FindUserByIdUseCase $findUserByIdUseCase)
    {
        $this->UserRepository      = $UserRepository; 
        $this->findUserByIdUseCase = $findUserByIdUseCase;
    }

    public function __invoke(int $id, array $params)
    {
        $User = $this->findUserByIdUseCase->__invoke($id);
        $this->UserRepository->beginTransaction();
        $result = $this->UserRepository->update($User, $params);
        $this->UserRepository->commitTransaction();
        return $result;
    }
}