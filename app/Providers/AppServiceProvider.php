<?php

namespace App\Providers;

use App\Billing\PaymentGateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /* 
         * In my app i want to bind the following thing
         * So whenever anyone asks for a PaymentGateway, we do need to import that PaymentGateway
         * and pass the currency (in usd).
        */
        // $this->app->bind(PaymentGateway::class, function ($app) {
        $this->app->singleton(PaymentGateway::class, function ($app) {
            return new PaymentGateway('usd');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Features::noBlade();
    }
}
