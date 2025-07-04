<?php

namespace App\Providers;

use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Blade::if('canAccess', function ($permission) {
            return auth()->check() && auth()->user()->hasPermission($permission);
        });

        // share the company setting data
        $companySettings = \App\Models\CompanySetting::all()->pluck('value', 'key')->toArray();
        view()->share('companySettings', $companySettings);
    }
}
