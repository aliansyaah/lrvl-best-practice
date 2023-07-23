<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class FacadeTest extends TestCase
{
    public function testConfig()
    {
        $firstName = config('contoh.author.first');     // contoh HELPER FUNCTION 'config'
        $firstName2 = Config::get('contoh.author.first');   // contoh FACADES 'Config'

        assertEquals($firstName, $firstName2);
        
        var_dump(Config::all());    // jika ingin mengambil semua config
    }

    public function testConfigDependency()
    {
        $firstName1 = config("contoh.author.first");
        $firstName2 = Config::get("contoh.author.first");   // ini sama dgn $config->get() di bawah

        $config = $this->app->make("config");
        $firstName3 = $config->get("contoh.author.first");

        assertEquals($firstName1, $firstName2);
        assertEquals($firstName1, $firstName3);

        var_dump(Config::all());
    }

    public function testFacadeMock()
    {
        Config::shouldReceive('get')
            ->with('contoh.author.first')
            ->andReturn('Ali kasep');
            
        $firstName = Config::get('contoh.author.first');

        assertEquals('Ali kasep', $firstName);
    }
}
