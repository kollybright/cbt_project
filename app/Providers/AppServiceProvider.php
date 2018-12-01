<?php

namespace App\Providers;
use Validator;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        Validator::extend('foo',function($attribute,$value,$parameters,$validator){
//            return $value== 'foo';
//        });
//        Validator::extend('admin_login','Admin@valid_login');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
