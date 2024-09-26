<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Boot\FindBootByIdRequest;
use App\Http\Requests\Boot\BootIndexRequest;
use App\Http\Requests\Boot\TransactionalBootRequest;
use App\UseCases\Boot\Find\FindBootAllUseCase;
use App\UseCases\Boot\Find\FindBootByIdUseCase;
use App\UseCases\Boot\StoreBootUseCase;
use App\UseCases\Boot\UpdateBootUseCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BootController extends Controller
{
    private FindBootAllUseCase    $findBootAllUseCase;
    private FindBootByIdUseCase   $findBootByIdUseCase;
    private UpdateBootUseCase     $updateBootUseCase;
    private StoreBootUseCase      $storeBootUseCase;
    

    public function __construct(
        FindBootAllUseCase $findBootAllUseCase, 
        FindBootByIdUseCase  $findBootByIdUseCase,
        UpdateBootUseCase     $updateBootUseCase,
        StoreBootUseCase      $storeBootUseCase
    ){
        $this->findBootAllUseCase   = $findBootAllUseCase;
        $this->findBootByIdUseCase  = $findBootByIdUseCase;
        $this->updateBootUseCase    = $updateBootUseCase;
        $this->storeBootUseCase     = $storeBootUseCase;
    }

    public function index(BootIndexRequest $request)
    {
        $records = $this->findBootAllUseCase->__invoke();

        if ($request->ajax()) {
            return response()->json(['records' => $records]);
        }
    
        return view('Boot.index', [
            'user' => Auth::user(),
            'records' => $records,
        ]);
    } 


    public function getBootById(FindBootByIdRequest $request){
        if (!$request->ajax()) abort(404);
            $params = (object)$request->validated();
            return response()->json(['record' => $this->findBootByIdUseCase->__invoke($params->id)->mapped()]);
        
        
    }

    public function store(TransactionalBootRequest $request){
        if (!$request->ajax()) abort(404);
            $params = (object)$request->validated();
            DB::beginTransaction();
            $data =  $this->storeBootUseCase->__invoke($params);
            DB::commit();
            return response()->json(['record' =>$data]);
        
      
    }

    public function update(TransactionalBootRequest $request){
        if (!$request->ajax()) abort(404);
            $params = $request->validated();
            DB::beginTransaction();
            $data = $this->updateBootUseCase->__invoke($params->id, $params);
            DB::commit();
            return response()->json(['record' =>$data->mapped()]);
    }
}
