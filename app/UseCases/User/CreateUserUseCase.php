<?php
namespace App\UseCases\User;
use App\Class\BaseTransaction;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class CreateUserUseCase {
    protected $userRepository;
    protected $transaction;

    public function __construct(BaseTransaction $transaction, UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
        $this->transaction = $transaction;
    }

    public function execute(array $data) {
        try {
            $this->transaction->beginTransaction();
            $data['password'] = Hash::make($data['password']);
            $result = $this->userRepository->create($data);
            return $result;
        } catch (\Exception $e) {
            $this->transaction->rollbackTransaction();
            $this->transaction->throwNewQueryException($e->getMessage());
        }

           
   
    }
}
