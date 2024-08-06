<?php
namespace App\UseCases\User;

use App\Interfaces\UserRepositoryInterface;
use App\Class\BaseTransaction;
use App\Exceptions\GeneralException;

class DeleteUserUseCase {
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
            if ($user) {
                throw new GeneralException(__('user has not been deleted '));
            }

            $result = $this->userRepository->restore($id);

            if (!$result) {
                throw new GeneralException(__('Failed to restore user.'));
            }

            return $result;
        } catch (\Exception $e) {
            $this->transaction->rollbackTransaction();
            $this->transaction->throwNewQueryException($e->getMessage());
        }
    }
}
