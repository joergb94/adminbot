<?php
namespace App\UseCases\User;

use App\Interfaces\UserRepositoryInterface;
use App\Exceptions\GeneralException;
use App\Class\BaseTransaction;
use Illuminate\Support\Facades\Hash;
class UpdatePassUserUseCase {
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
                throw new GeneralException(__('User not found.'));
            }
            
            $result = $this->userRepository->updatePassword($user, $data);

            if (!$result) {
                throw new GeneralException(__('Failed to update password user.'));
            }
            return $result;

        } catch (\Exception $e) {
            $this->transaction->rollbackTransaction();
            $this->transaction->throwNewQueryException($e->getMessage());
        }
    }
}
