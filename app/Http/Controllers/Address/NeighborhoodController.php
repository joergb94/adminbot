<?php

namespace App\Http\Controllers\Address;

use App\Http\Controllers\Controller;
use App\Http\Requests\Address\Neighbourhood\FindNeighbourhoodByZipRequest;
use App\UseCases\Address\Neighbourhood\Find\FindNeighbourhoodByZipUseCase;

class NeighborhoodController extends Controller
{
    private FindNeighbourhoodByZipUseCase $findNeighbourhoodByZipUseCase;

    public function __construct(FindNeighbourhoodByZipUseCase $findNeighbourhoodByZipUseCase){
        $this->findNeighbourhoodByZipUseCase = $findNeighbourhoodByZipUseCase;
    }

    public function zip(FindNeighbourhoodByZipRequest $request){
        $param = (object)$request->validated();
        return $this->findNeighbourhoodByZipUseCase->__invoke($param);        
    }
}
