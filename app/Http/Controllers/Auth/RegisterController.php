<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\User\UserRegisterRequest;
use App\Http\Requests\User\UserVerificationRequest;
use App\UseCases\Register\User\StoreUserUseCase;
use App\UseCases\Register\User\VerificationUserUseCase;
use Illuminate\Support\Facades\Auth;



class RegisterController extends Controller
{
    

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    private StoreUserUseCase $storeUserUseCase;
    private VerificationUserUseCase $verificationUserUseCase;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(StoreUserUseCase $storeUserUseCase,VerificationUserUseCase $verificationUserUseCase)
    {
        $this->middleware('guest')->except('logout');
        $this->storeUserUseCase = $storeUserUseCase;
        $this->verificationUserUseCase = $verificationUserUseCase;

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
   public function create(UserRegisterRequest $request)
    {  
        $data = $request->validated();
        return $this->storeUserUseCase->__invoke((object) $data);
    }

    public function showRegisterForm(){
        if (Auth::check()) {
            return redirect('/home');
        } else {
            return view('auth.register', ['name'=>'This a name comes from route']);
        }
       
    }

    public function verifyAccount(UserVerificationRequest $request){
        $params = (object)$request;
        $user = $this->verificationUserUseCase->__invoke($params);
        if(!$user){
            abort(419);
        }
        return view('auth.verification');
    }

    public function activeAccount(UserRegisterRequest $request){
        
    }

    
    
    
}
