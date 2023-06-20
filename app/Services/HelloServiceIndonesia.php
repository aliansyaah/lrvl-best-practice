<?php

namespace App\Services;

class HelloServiceIndonesia implements HelloService
{
    // Fungsi hello dgn parameter 'name' & return type string
    public function hello(string $name): string
    {
        return "Halo $name";
    }
}