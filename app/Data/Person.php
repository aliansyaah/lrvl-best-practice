<?php

namespace App\Data;

class Person
{
    public function __construct(
        // Fitur PHP 8, bisa lgsg deklarasi property di dalam constructor
        public string $firstName,
        public string $lastName,
    )
    {
        
    }
}