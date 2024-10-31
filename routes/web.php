<?php

// use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\Admin\AttendingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\YearController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
// Suggested code may be subject to a license. Learn more: ~LicenseLog:1153587176.
use App\Http\Controllers\AdminEnrollmentController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\VisionMissionController;
use App\Http\Controllers\DiscountController;

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


//Landing Page
Route::get('/',[HomeController::class, 'index']);

//Authenticaiton
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/proses-login',[AuthController::class, 'prosesLogin'])->name('proses-login');
Route::get('/logout',[AuthController::class, 'logout'])->name('logout');
Route::post('/register',[RegisterController::class, 'store'])->name('store.register');
Route::post('/verification',[RegisterController::class, 'verifyOtp'])->name('verify.otp');
Route::get('/reset-password',[AuthController::class, 'show_reset'])->name('show.reset');
Route::post('/reset-password',[AuthController::class, 'reset_password'])->name('reset.password');

Route::get('/reset-password/{token}', [AuthController::class, 'show_reset_password'])
    ->name('show.reset.password');
Route::post('/action/reset-password/', [AuthController::class, 'action_reset_password'])
    ->name('action.password.reset');
    

Route::group(['middleware' => ['auth:user']],function(){
    Route::get('/verification',[RegisterController::class, 'verifPage'])->name('page.verif');
    Route::get('/resend/otp',[RegisterController::class, 'reSend'])->name('otp.resend');

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

        Route::controller(SessionController::class)->group(function(){
            Route::get('/course/{slug}/session', 'index')->name('admin.course.session');
            Route::get('/course/{slug}/get-session', 'store')->name('admin.course.get.session');
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
            Route::get('/instructor/update/status/{id}', 'updateStatus')->name('admin.instructor.update.status');
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
            Route::get('/year/update/publish/{id}', 'updatePublished')->name('admin.year.update.publish');
        });

        Route::controller(TransactionController::class)->group(function(){
            Route::get('/transaction', 'index')->name('admin.transaction');
            Route::get('/transaction/{id}/show', 'show')->name('admin.transaction.show');
            Route::get('/transaction/{id}/set-cancel', 'setCancel')->name('admin.transaction.set.cancel');
            Route::get('/transaction/{id}/set-payment-receive', 'setPaymentReceive')->name('admin.transaction.set.payment.receive');
            Route::get('/transaction/{id}/set-archive', 'setArchive')->name('admin.transaction.set.archive');
        });

        Route::controller(EnrollmentController::class)->group(function(){
            Route::get('/enrollment', 'index')->name('admin.enrollment');
            Route::get('/enrollment/{course_id}/', 'show')->name('admin.enrollment.show');
            Route::get('/enrollment/{id}/update-status', 'updateStatus')->name('admin.enrollment.update.status');
        });

        Route::controller(AttendingController::class)->group(function(){
            Route::get('/attending', 'index')->name('admin.attending');
            Route::get('/attending/{slug}/show', 'show')->name('admin.attending.show');
            Route::post('/attending/update-status', 'updateStatus')->name('admin.attending.update.status');
            Route::get('/attending/{slug}/report', 'showReport')->name('admin.attending.report');
        });

        Route::controller(DiscountController::class)->group(function(){
            Route::get('/discount', 'index')->name('admin.discount');
            Route::get('/discount/create', 'create')->name('admin.discount.create');
            Route::post('/discount/store', 'store')->name('admin.discount.store');
            Route::get('/discount/edit/{id}', 'edit')->name('admin.discount.edit');
            Route::post('/discount/update/{id}', 'update')->name('admin.discount.update');
            Route::get('/discount/update/{id}', 'updateStatus')->name('admin.discount.update.status');
            Route::get('/discount/delete/{id}', 'delete')->name('admin.discount.delete');
        });

        Route::controller(ProfileController::class)->group(function(){
            Route::get('/profile/edit', 'edit')->name('admin.profile.edit');
            Route::post('/profile/update', 'update')->name('admin.profile.update');
            Route::get('/profile/password', 'editPassword')->name('admin.profile.password');
            Route::post('/profile/update/password', 'updatePassword')->name('admin.profile.update.password');
        });
        

    });

    
});