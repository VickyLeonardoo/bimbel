<?php

// use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Admin\VisionMissionController;
use Illuminate\Support\Facades\Route;
// Suggested code may be subject to a license. Learn more: ~LicenseLog:1153587176.
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\YearController;

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

Route::group(['middleware' => ['auth:user']],function(){
    Route::group(['middleware' => ['cek_login:1'], 'prefix' => 'admin'],function(){

        Route::controller(DashboardController::class)->group(function(){
            Route::get('/dashboard', 'index')->name('admin.dashboard');
        });

        Route::controller(CourseController::class)->group(function(){ 
            Route::get('/course', 'index')->name('admin.course');
            Route::get('/course/create', 'create')->name('admin.course.create');
            Route::post('/course/store', 'store')->name('admin.course.store');
            Route::get('/course/edit/{slug}', 'edit')->name('admin.course.edit');
            Route::post('/course/update/{id}', 'update')->name('admin.course.update');
            Route::get('/course/delete/{id}', 'delete')->name('admin.course.delete');
        });

        Route::controller(InstructorController::class)->group(function(){
            Route::get('/instructor', 'index')->name('admin.instructor');
            Route::get('/instructor/create', 'create')->name('admin.instructor.create');
            Route::post('/instructor/store', 'store')->name('admin.instructor.store');
            Route::get('/instructor/edit/{slug}', 'edit')->name('admin.instructor.edit');
            Route::post('/instructor/update/{id}', 'update')->name('admin.instructor.update');
            Route::get('/instructor/delete/{id}', 'delete')->name('admin.instructor.delete');

            Route::post('/instructor/edit/education/{id}', 'editAddEducation')->name('admin.instructor.edit.add.education');
            Route::post('/instructor/edit/course/{id}', 'editAddCourse')->name('admin.instructor.edit.add.course');
            Route::get('/instructor/delete/education/{id}', 'deleteEducation')->name('admin.instructor.delete.education');
            Route::get('/instructor/delete/course/{id}', 'deleteCourse')->name('admin.instructor.delete.course');
        });

        Route::controller(VisionMissionController::class)->group(function(){
            Route::get('/visi', 'visi')->name('admin.visi');
            Route::get('/visi/create', 'visi_create')->name('admin.visi.create');
            Route::post('/visi/store', 'visi_store')->name('admin.visi.store');

            Route::get('/misi', 'misi')->name('admin.misi');
            Route::get('/misi/create', 'misi_create')->name('admin.misi.create');
            Route::post('/misi/store', 'misi_store')->name('admin.misi.store');
        });
        
        Route::controller(YearController::class)->group(function(){
            Route::get('/year', 'index')->name('admin.year');
            Route::get('/year/create', 'create')->name('admin.year.create');
            Route::post('/year/store', 'store')->name('admin.year.store');
            Route::get('/year/edit/{id}', 'edit')->name('admin.year.edit');
            Route::post('/year/update/{id}', 'update')->name('admin.year.update');
            Route::get('/year/delete/{id}', 'delete')->name('admin.year.delete');
            Route::get('/year/update/status/{id}', 'updateStatus')->name('admin.year.update.status');
        });
    });
});