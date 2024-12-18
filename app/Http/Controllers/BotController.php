<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bot\FindBotByIdRequest;
use App\Http\Requests\Bot\FindBotByNameRequest;
use App\Http\Requests\Bot\BotIndexRequest;
use App\Http\Requests\Bot\TurnOnOrOffBotRequest;
use App\Http\Requests\Bot\TransactionalBotRequest;
use App\UseCases\Bot\Find\FindBotAllUseCase;
use App\UseCases\Bot\Find\FindBotByIdUseCase;
use App\UseCases\Bot\Find\FindBotByNameUseCase;
use App\UseCases\Bot\StoreBotUseCase;
use App\UseCases\Bot\UpdateBotUseCase;
use App\UseCases\Bot\TurnOnorOffBotUseCase;
use App\UseCases\Bot\DeleteBotUseCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BotController extends Controller
{
    private FindBotAllUseCase    $findBotAllUseCase;
    private FindBotByIdUseCase   $findBotByIdUseCase;
    private FindBotByNameUseCase $findBotByNameUseCase;
    private UpdateBotUseCase     $updateBotUseCase;
    private StoreBotUseCase      $storeBotUseCase;
    private TurnOnorOffBotUseCase $turnOnorOffBotUseCase;
    private DeleteBotUseCase $deleteBotUseCase;
    

    public function __construct(
        FindBotAllUseCase $findBotAllUseCase, 
        FindBotByIdUseCase  $findBotByIdUseCase,
        FindBotByNameUseCase $findBotByNameUseCase,
        UpdateBotUseCase     $updateBotUseCase,
        StoreBotUseCase      $storeBotUseCase,
        TurnOnorOffBotUseCase $turnOnorOffBotUseCase, 
        DeleteBotUseCase $deleteBotUseCase
    ){
        $this->findBotAllUseCase   = $findBotAllUseCase;
        $this->findBotByIdUseCase  = $findBotByIdUseCase;
        $this->findBotByNameUseCase = $findBotByNameUseCase;
        $this->updateBotUseCase    = $updateBotUseCase;
        $this->storeBotUseCase     = $storeBotUseCase;
        $this->turnOnorOffBotUseCase = $turnOnorOffBotUseCase;
        $this->deleteBotUseCase = $deleteBotUseCase;
    }

    public function index(BotIndexRequest $request)
    {
        $records = $this->findBotAllUseCase->__invoke();

        if ($request->ajax()) {
            return response()->json(['records' => $records]);
        }
    
        return view('Bot.index', [
            'user' => Auth::user(),
            'records' => $records,
        ]);
    } 


    public function getBotById(FindBotByIdRequest $request){
        if (!$request->ajax()) abort(404);
            $params = (object)$request->validated();
            return response()->json(['record' => $this->findBotByIdUseCase->__invoke($params->id)->mapped()]);
        
        
    }

    public function getBotByName(FindBotByNameRequest $request){
        if (!$request->ajax()) abort(404);
            $params = (object)$request->validated();
            return response()->json(['record' => $this->findBotByNameUseCase->__invoke($params->name)]);
    }

    public function store(TransactionalBotRequest $request){
        if (!$request->ajax()) abort(404);
            $params = (object)$request->validated();
            $data =  $this->storeBotUseCase->__invoke($params);
            return response()->json(['record' =>$data]);
        
      
    }

    public function update(TransactionalBotRequest $request){
        if (!$request->ajax()) abort(404);
            $params = $request->validated();
            DB::beginTransaction();
            $data = $this->updateBotUseCase->__invoke($params['id'], (object) $params);
            DB::commit();
            return response()->json(['record' =>$data->mapped()]);
    }


    public function turnOnOrOffBot(TurnOnOrOffBotRequest $request){
        if (!$request->ajax()) abort(404);
            $params = $request->validated();
            DB::beginTransaction();
            $data =  $this->turnOnorOffBotUseCase->__invoke($params['id'], $params);
            DB::commit();
            return response()->json(['record' =>$data]);
    }

    public function deleteBot(FindBotByIdRequest $request){
        if (!$request->ajax()) abort(404);
            $params = $request->validated();
            DB::beginTransaction();
            $data =  $this->deleteBotUseCase->__invoke($params['id']);
            DB::commit();
            return response()->json(['record' =>$data]);
    }
}
