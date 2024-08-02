<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\TransactionController;

Route::controller(HomeController::class)->group(function(){
    Route::get('/client/home', 'index')->name('client.home');
    Route::get('/client/programme','programme')->name('client.programme');
    Route::get('/client/instructor','instructor')->name('client.instructor');
});

Route::group(['middleware' => ['auth:user']],function(){
    Route::group(['middleware' => ['cek_login:2']],function(){

        Route::controller(ProfileController::class)->group(function(){
            // Parent Profile
            Route::get('/client/profile', 'index')->name('client.profile');
            Route::get('/client/edit_profile', 'editProfile')->name('client.edit_profile');
            Route::post('/client/edit_profile', 'updateProfile')->name('client.update_profile');

            //Children Profile
            Route::get('/client/add_children', 'addChildren')->name('client.add_children');
            Route::post('/client/add_children', 'storeChildren')->name('client.store_children');
            Route::get('/client/edit_children/{id}', 'editChildren')->name('client.edit_children');
            Route::post('/client/edit_children/{id}', 'updateChildren')->name('client.update_children');
            Route::get('/client/delete_children/{id}', 'deleteChildren')->name('client.delete_children');
        });

        Route::controller(TransactionController::class)->group(function(){
            Route::get('/client/transaction', 'index')->name('client.transaction');
            Route::get('/client/transaction/create', 'create')->name('client.transaction.create');
            Route::get('/client/transaction/{id}', 'show')->name('client.transaction.show');
            Route::post('/client/transaction', 'store')->name('client.transaction.store');
            Route::get('/client/transaction/{id}/edit', 'edit')->name('client.transaction.edit');
            Route::post('/client/transaction/{id}/update', 'update')->name('client.transaction.update');
            Route::get('/client/transaction/{id}/upload', 'viewUpload')->name('client.transaction.page.upload');
            Route::post('/client/transaction/{id}/upload', 'upload')->name('client.transaction.upload');
        });

        Route::controller(OrderController::class)->group(function(){
            Route::get('/order', 'index')->name('pelanggan.order');
            Route::get('/order/{id}', 'show')->name('pelanggan.order.show');
        });

        Route::post('/check-discount', [DiscountController::class, 'checkDiscount'])->name('check.discount');

    });
});
