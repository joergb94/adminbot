<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use RuntimeException;

class DBQueryException extends RuntimeException{
    public function render(){
        return new JsonResponse(['message' => $this->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}