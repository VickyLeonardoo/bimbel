<?php

use App\Http\Controllers\Auth\AuthController as AuthAuthController;
use Illuminate\Support\Facades\Route;
// Suggested code may be subject to a license. Learn more: ~LicenseLog:1153587176.
use App\Http\Controllers\AuthController;

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


// Suggested code may be subject to a license. Learn more: ~LicenseLog:2685067153.
Route::get('/login', [AuthAuthController::class, 'login']);
// Suggested code may be subject to a license. Learn more: ~LicenseLog:3929640191.
Route::get('/register', [AuthAuthController::class, 'register']);