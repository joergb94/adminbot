<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\GeneralException;
use App\UseCases\Register\User\Find\FindUserByEmailActivedUseCase;

class LoginController extends Controller
{   

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/inicio';
    protected FindUserByEmailActivedUseCase $findUserByEmailActivedUseCase;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FindUserByEmailActivedUseCase $findUserByEmailActivedUseCase)
    {
        $this->middleware('guest')->except('logout');
        $this->findUserByEmailActivedUseCase = $findUserByEmailActivedUseCase;
    }

    public function showLoginForm(){
        
        if (Auth::check()) {
            return redirect('/inicio');
        } else {
            return view('auth.login');
        }
    }

     /**
     * Handle an incoming authentication request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['email'] = strtolower(trim($credentials['email']));
        $user = $this->findUserByEmailActivedUseCase->__invoke($credentials['email']);
   
        if (is_null($user)) {
            throw new GeneralException('Esta cuenta de correo aun no esta registrada, por favor cree una!');
        }

        if ($user == false) {
            throw new GeneralException('La cuenta aún no se ha verificado!');
        }
        
        if (!Auth::attempt($credentials)) {
            throw new GeneralException('Las credenciales son incorrectas!');
        }

        return redirect()->intended('/inicio'); // Redirect to the intended URL or home page
        
    }

    /**
     * Handle an incoming logout request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out

        return redirect()->route('login'); // Redirect to the login page
    }
}
