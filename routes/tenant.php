<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Tenant\Auth\Login;
use App\Livewire\Tenant\Dashboard;
use App\Livewire\Error404;
use App\Livewire\Tenant\Profile;

Route::group(['prefix' => 'tenant', 'as' => 'tenant.'], function () {
    Route::get('404', Error404::class)->name('404');

    Route::group(['middleware' => 'tenant.guest'], function () {
        Route::get('login', Login::class)->name('login');
    });
    Route::group(['middleware' => 'tenant.auth'], function () {
        Route::get('dashboard', Dashboard::class)->name('dashboard');
        Route::get('profile', Profile::class)->name('profile');
        Route::get('service-ticket-list', \App\Livewire\Tenant\ServiceTicketList::class)->name('service-ticket-list');
        Route::get('request-service/create', \App\Livewire\Tenant\CreateRequestService::class)->name('request-service.create');
    });
});


