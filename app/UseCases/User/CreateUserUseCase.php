<?php
namespace App\UseCases\User;

use App\Interfaces\UserRepositoryInterface;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\DB;

class CreateUserUseCase {
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function execute(array $data) {
        return DB::transaction(function () use ($data) {
            $result = $this->userRepository->create($data);
            
            if (!$result) {
                throw new GeneralException(__('Failed to update user.'));
            }

            return $result;
        });
    }
}
