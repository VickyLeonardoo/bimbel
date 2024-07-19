<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\OrderController;

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

        });

        Route::controller(OrderController::class)->group(function(){
            Route::get('/order', 'index')->name('pelanggan.order');

        });
    });
});
