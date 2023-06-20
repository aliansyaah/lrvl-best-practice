<?php

namespace App\Services;

interface HelloService
{
    // Fungsi hello dgn parameter 'name' & return type string
    public function hello(string $name): string;
}