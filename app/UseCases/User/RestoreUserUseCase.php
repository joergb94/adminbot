<?php
namespace App\UseCases\User;

use App\Interfaces\UserRepositoryInterface;
use App\Exceptions\GeneralException;
use App\Class\BaseTransaction;

class RestoreUserUseCase {
    protected $userRepository;
    protected $transaction;

    public function __construct(BaseTransaction $transaction, UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
        $this->transaction = $transaction;
    }

    public function execute(int $id, array $data): bool {
        $user = $this->userRepository->find($id);

        try {
            $this->transaction->beginTransaction();
            if (!$user) {
                throw new GeneralException(__('User not found'));
            }

            $result = $this->userRepository->delete($id);

            if (!$result) {
                throw new GeneralException(__('Failed to delete user.'));
            }

            return $result;
        } catch (\Exception $e) {
            $this->transaction->rollbackTransaction();
            $this->transaction->throwNewQueryException($e->getMessage());
        }
    }
}
