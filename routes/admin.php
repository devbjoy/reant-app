<?php

use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Permission\CreatePermission;
use App\Livewire\Admin\Permission\TrashList;
use App\Livewire\Admin\Role\PermissionList;
use App\Livewire\Admin\Role\RoleCreate;
use App\Livewire\Admin\Role\RoleEdit;
use App\Livewire\Admin\Role\RoleList;
use App\Livewire\Admin\User\CreateUser;
use App\Livewire\Admin\User\EditUser;
use App\Livewire\Admin\User\TrashedUser;
use App\Livewire\Admin\User\UserList;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Error404;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('404', Error404::class)->name('404');
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('login', Login::class)->name('login');
    });
    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('dashboard', Dashboard::class)->name('dashboard');
        Route::get('company-setting', \App\Livewire\Admin\CompanySetting::class)->name('company-setting');
        Route::get('profile', \App\Livewire\Admin\Porfile::class)->name('profile');
        // user route
        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::get('/', UserList::class)->name('list');
            Route::get('create', CreateUser::class)->name('create');
            Route::get('{id}/edit', EditUser::class)->name('edit');
            Route::get('trash', TrashedUser::class)->name('trash');
        });
        // Permission route
        Route::group(['prefix' => 'permissions', 'as' => 'permissions.'], function () {
            Route::get('/', \App\Livewire\Admin\Permission\PermissionList::class)->name('list');
            Route::get('create', CreatePermission::class)->name('create');
            Route::get('{id}/edit', CreatePermission::class)->name('edit');
            Route::get('trash', TrashList::class)->name('trash');
        });
        // role route
        Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
            Route::get('/', RoleList::class)->name('list');
            Route::get('create', RoleCreate::class)->name('create');
            Route::get('{id}/edit', RoleEdit::class)->name('edit');
            Route::get('trash', \App\Livewire\Admin\Role\TrashList::class)->name('trash');
            Route::get('{id}/permission', PermissionList::class)->name('permission');
        });
    });
});