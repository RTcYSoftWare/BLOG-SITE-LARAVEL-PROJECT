<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting; # bütün sayfalarda site ayarlarını göstermek için modelimizi dahil ettik.

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share("config",Setting::findOrFail(1)); # bütün view'lara config isimli değiken yolladık.
    }
}
