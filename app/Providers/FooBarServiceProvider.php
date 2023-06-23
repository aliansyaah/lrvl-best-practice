<?php

namespace App\Providers;

use App\Data\Bar;
use App\Data\Foo;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

// class FooBarServiceProvider extends ServiceProvider
class FooBarServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        HelloService::class => HelloServiceIndonesia::class
    ];

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
        // echo "FooBarServiceProvider";
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

    /* 
     * Override method provides pada class ServiceProvider
     * Untuk memberi flag "lazy" pada class FooBarServiceProvider agar class yang dimasukkan
     * pada method provides() di bawah tidak akan selalu diload, hanya diload ketika dibutuhkan.
    */
    public function provides()
    {
        return [HelloService::class, Foo::class, Bar::class];
    }
}
