<?php

use App\Livewire\Admin\Auth\Login;
use App\Livewire\Dashboard;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('login', Login::class)->name('login');
    });
    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('dashboard', Dashboard::class)->name('dashboard');
    });
});