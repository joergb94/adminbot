<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UseCases\Bot\Find\FindBotAllUseCase;


class HomeController extends Controller
{   
    private FindBotAllUseCase    $FindBotAllUseCase;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct( FindBotAllUseCase $FindBotAllUseCase,)
    {
        $this->middleware('auth');
        $this->FindBotAllUseCase   = $FindBotAllUseCase;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $user = Auth::user();
        $records = $this->FindBotAllUseCase->__invoke();
        return view('home.index',['user'=>$user,'bots'=>count($records)]);
    }
}
