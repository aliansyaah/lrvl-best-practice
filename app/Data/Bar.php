<?php

namespace App\Data;

class Bar
{
    private Foo $foo;

    /* Dependency injection di sini saat kita memasukkan object Foo ke dalam Bar, sehingga Bar bisa menggunakan object Foo */
    public function __construct(Foo $foo)
    {
        $this->foo = $foo;
    }

    public function bar(): string
    {
        return $this->foo->foo().' and Bar';
    }
}