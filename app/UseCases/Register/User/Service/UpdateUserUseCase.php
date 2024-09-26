<?php 
namespace App\UseCases\Register\User\Service;

use App\Repositories\UserRepository;
use App\Models\User;

final class UpdateUserUseCase {
    private UserRepository $UserRepository;

    public function __construct(UserRepository $UserRepository)
    {
        $this->UserRepository = $UserRepository; 
    }

    public function __invoke(User $user, array $params)
    {
        return $this->UserRepository->update($user, $params);
    }
}