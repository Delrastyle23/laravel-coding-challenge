<?php

namespace App\Providers;

use App\Models\Referral;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

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
        //
 
        Schema::defaultstringLength(191);

        Validator::extend('limit_referral', function ($attribute, $value, $parameters, $validator) {
            return Referral::where('user_id', $parameters[0])->where('status',1)->count() < 10;
        }, 'Reach the limit.');

    }
}
