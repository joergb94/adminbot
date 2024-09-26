<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Registers\RegistersRequest;
use App\Http\Resources\MapCollectionResource;
use App\UseCases\Register\GetRegisterMainUseCase;

class RegistersController extends Controller
{
    private GetRegisterMainUseCase $getRegisterMainUseCase;

    public function __construct(GetRegisterMainUseCase $getRegisterMainUseCase ){ //inyectas el caso de uso 
        $this->getRegisterMainUseCase = $getRegisterMainUseCase;
    }

    public function getRegisters(RegistersRequest $request ) {
        if (!$request->ajax()) abort(404);
        $params = ( object ) $request->validated();
        return response()->json(['records' => $this->getRegisterMainUseCase->__invoke( $params )]);
    }

}