<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\UseCases\User\CreateUserUseCase;
use app\Http\Requests\Users\UserRegisterRequest;


class RegisteredUserController extends Controller
{
    
    protected $createUserUseCase;

    public function __construct(CreateUserUseCase $createUserUseCase) {
        $this->createUserUseCase = $createUserUseCase;
    }

    public function create(): View
    {
        return view('auth.register');
    }

    public function store(UserRegisterRequest $request): RedirectResponse
    {   
        $data = $request->validated();
        $user =  $this->createUserUseCase->execute($data);
        event(new Registered($user));
 
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}


