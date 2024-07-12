<?php

// use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
// Suggested code may be subject to a license. Learn more: ~LicenseLog:1153587176.
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::get('/', function () {
    return view('welcome');
});

//Authenticaiton
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/proses-login',[AuthController::class, 'prosesLogin'])->name('proses-login');
Route::get('/logout',[AuthController::class, 'logout'])->name('logout');
Route::post('/register',[RegisterController::class, 'store'])->name('store.register');