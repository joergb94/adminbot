<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BotController;
use App\Http\Controllers\RegistersController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LoginController::class, 'showLoginForm']);
Route::view('/offline', 'vendor.laravelpwa.offline')->name('offline');
Route::get(__('routes.customer.login'), [LoginController::class, 'showLoginForm'])->name('login');
Route::post(__('routes.customer.login'), [LoginController::class, 'login'])->name('login.submit');

Route::get(__('routes.customer.register'), [RegisterController::class, 'showRegisterForm']);
Route::post(__('routes.customer.register'), [RegisterController::class, 'create'])->name('register.submit');

Route::get(__('routes.customer.verify'), [RegisterController::class, 'verifyAccount']);
Route::post(__('routes.customer.verify'), [RegisterController::class, 'verifyAccount'])->name('verify.submit');

Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/register', [RegistersController::class, 'getRegisters']);
  
    Route::get(__('routes.customer.home'), [HomeController::class, 'index'])->name('home');

    Route::get(__('routes.customer.bots'), [BotController::class, 'index'])->name('my-bots');
    Route::get(__('routes.customer.bot'), [BotController::class, 'getBotByById'])->name('bot');
    Route::get(__('routes.customer.bot.nombre'), [BotController::class, 'getBotByName'])->name('bot');
    Route::post(__('routes.customer.bot'), [BotController::class, 'store'])->name('bot.store');
    Route::put(__('routes.customer.bot'), [BotController::class, 'update'])->name('bot.update');
});





