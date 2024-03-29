<?php

namespace App\Providers;

use App\Billing\BankPaymentGateway;
use App\Billing\CreditPaymentGateway;
use App\Billing\PaymentGatewayContract;
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
         * So whenever anyone asks for a BankPaymentGateway, we do need to import 
         * that BankPaymentGateway and pass the currency (in usd).
        */
        // $this->app->bind(BankPaymentGateway::class, function ($app) {
        // $this->app->singleton(BankPaymentGateway::class, function ($app) {
        $this->app->singleton(PaymentGatewayContract::class, function ($app) {
            /* 
             * Jika request metode pembayaran menggunakan credit, return CreditPaymentGateway
             * http://localhost:8000/pay?credit=true
            */
            if (request()->has('credit')) {
                return new CreditPaymentGateway('usd');
            }
            return new BankPaymentGateway('usd');
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
