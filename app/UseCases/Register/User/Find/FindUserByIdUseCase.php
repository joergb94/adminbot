<?php 
namespace App\UseCases\Register\User\Find;

use App\Http\Resources\HttpResponseExceptionApi;
use App\Repositories\UserRepository;
use App\Exceptions\GeneralException;

final class FindUserByIdUseCase {
    private UserRepository $UserRepository;

    public function __construct(UserRepository $UserRepository) {
        $this->UserRepository = $UserRepository;  
    }

    public function __invoke(int $UserId) {
        $result = $this->UserRepository->findById($UserId);
        return $this->validateExist($result);
    }

    public function validateExist($result) {
        if(is_null($result)) {
            throw new GeneralException('El Usere seleccionado por ID no existe!');
        }
        return $result;
    }
}