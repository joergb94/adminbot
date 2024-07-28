<?php
namespace App\UseCases\User;

use App\Interfaces\UserRepositoryInterface;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\DB;

class UpdateUserUseCase {
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function execute(int $id, array $data): bool {
        $user = $this->userRepository->find($id);

        return DB::transaction(function () use ($user, $data) {
            if (!$user) {
                throw new GeneralException(__('User not found.'));
            }

            $result = $this->userRepository->update($user, $data);

            if (!$result) {
                throw new GeneralException(__('Failed to update user.'));
            }

            return $result;
        });
    }
}
