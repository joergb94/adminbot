<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UseCases\Finance\Entity\Find\FindEntityAllUseCase;

class HomeController extends Controller
{   
    private FindEntityAllUseCase    $findEntityAllUseCase;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct( FindEntityAllUseCase $findEntityAllUseCase,)
    {
        $this->middleware('auth');
        $this->findEntityAllUseCase   = $findEntityAllUseCase;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $user = Auth::user();
        $records = $this->findEntityAllUseCase->__invoke();
        return view('home.index',['user'=>$user,'entity'=>count($records)]);
    }
}
