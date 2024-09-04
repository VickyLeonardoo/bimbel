<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Instructor\AttendingController;
use App\Http\Controllers\Instructor\DashboardController;
use App\Http\Controllers\Instructor\ProfileController;

Route::controller(DashboardController::class)->group(function(){
    Route::get('/dashboard', 'index')->name('instructor.dashboard');
    
});

Route::controller(AttendingController::class)->group(function(){
    Route::get('/attending', 'index')->name('instructor.attending');
    Route::get('/attending/{slug}/show', 'show')->name('instructor.attending.show');
    Route::post('/attending/update-status', 'updateStatus')->name('instructor.attending.update.status');
    Route::get('/attending/{slug}/report', 'showReport')->name('instructor.attending.report');
});

Route::controller(ProfileController::class)->group(function(){
    Route::get('/profile', 'edit')->name('instructor.profile');
    Route::post('/profile/update', 'update')->name('instructor.profile.update');
});
