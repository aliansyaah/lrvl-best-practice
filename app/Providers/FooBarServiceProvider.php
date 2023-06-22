<?php

namespace App\Providers;

use App\Data\Bar;
use App\Data\Foo;
use Illuminate\Support\ServiceProvider;

class FooBarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     * 
     * Di register() kita harus melakukan registrasi dependency yg dibutuhkan ke Service Container
     * jangan melakukan kode selain registrasi dependency di function register(), jika tidak ingin
     * mengalami error dependency belum tersedia
     */
    public function register()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });
        $this->app->singleton(Bar::class, function ($app) {
            return new Bar($app->make(Foo::class));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     * 
     * Funtion boot() dipanggil setelah register() selesai, di sini kita bisa melakukan hal apapun
     * yang diperlukan setelah proses registrasi dependency selesai
     */
    public function boot()
    {
        //
    }
}
