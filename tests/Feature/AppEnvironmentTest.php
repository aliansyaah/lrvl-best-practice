<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

class AppEnvironmentTest extends TestCase
{
    public function testAppEnv()
    {
        // var_dump(App::environment());
        if (App::environment('testing')) {
            assertTrue(true);
        }
    }
}
