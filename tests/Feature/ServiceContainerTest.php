<?php

namespace Tests\Feature;

use App\Data\Foo;
use App\Data\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotSame;

class ServiceContainerTest extends TestCase
{
    public function testDependencyInjection()
    {
        // Code di bawah sama dengan sintax "$foo = new Foo();"
        $foo = $this->app->make(Foo::class);    // new Foo()
        $foo2 = $this->app->make(Foo::class);    // new Foo()

        assertEquals("Foo", $foo->foo());
        assertEquals("Foo", $foo2->foo());
        assertNotSame($foo, $foo2);
    }

    public function testBind()
    {
        // Tidak bisa menggunakan cara ini utk inject dependency yg punya parameter di construct-nya
        // $person = $this->app->make(Person::class);

        // Pakai bind()
        // Jika ada yg memanggil class Person, function closure yg akan dipanggil
        $this->app->bind(Person::class, function ($app) {
            // Function closure
            return new Person("Eko", "Khannedy");
        });

        // Setiap kita memanggil "make", function closure di atas akan dipanggil
        $person1 = $this->app->make(Person::class);     // new Person("Eko", "Khannedy");
        $person2 = $this->app->make(Person::class);     // new Person("Eko", "Khannedy");

        assertEquals("Eko", $person1->firstName);
        assertEquals("Eko", $person2->firstName);
        assertNotSame($person1, $person2);
    }
}
