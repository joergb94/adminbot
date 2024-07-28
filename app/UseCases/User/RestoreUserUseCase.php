<?php
namespace App\UseCases\User;

use App\Interfaces\UserRepositoryInterface;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\DB;

class RestoreUserUseCase {
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function execute(int $id, array $data): bool {
        $user = $this->userRepository->find($id);

        return DB::transaction(function () use ($id, $user) {
            if (!$user) {
                throw new GeneralException(__('User not found'));
            }

            $result = $this->userRepository->delete($id);

            if (!$result) {
                throw new GeneralException(__('Failed to delete user.'));
            }

            return $result;
        });
    }
}
