<?php
namespace App\UseCases\User;

use App\Interfaces\UserRepositoryInterface;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\DB;

class DeleteUserUseCase {
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function execute(int $id, array $data): bool {
        $user = $this->userRepository->find($id);

        return DB::transaction(function () use ($id, $user) {
            if ($user) {
                throw new GeneralException(__('user has not been deleted '));
            }

            $result = $this->userRepository->restore($id);

            if (!$result) {
                throw new GeneralException(__('Failed to restore user.'));
            }

            return $result;
        });
    }
}
