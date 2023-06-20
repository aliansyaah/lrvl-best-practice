<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotSame;
use function PHPUnit\Framework\assertSame;

class ServiceContainerTest extends TestCase
{
    public function testDependency()
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

    public function testSingleton()
    {
        // Pakai singleton()
        $this->app->singleton(Person::class, function ($app) {
            return new Person("Eko", "Khannedy");
        });

        // $person1 & $person2 adalah object yg sama, karena menggunakan singleton
        $person1 = $this->app->make(Person::class);     // new Person("Eko", "Khannedy"); if not exists
        $person2 = $this->app->make(Person::class);     // return existing

        assertEquals("Eko", $person1->firstName);
        assertEquals("Eko", $person2->firstName);
        assertSame($person1, $person2);
    }

    public function testInstance()
    {
        // Pakai instance()
        $person = new Person("Eko", "Khannedy");
        $this->app->instance(Person::class, $person);

        // $person, $person1 & $person2 adalah object yg sama
        $person1 = $this->app->make(Person::class);     // $person
        $person2 = $this->app->make(Person::class);     // $person

        assertEquals("Eko", $person1->firstName);
        assertEquals("Eko", $person2->firstName);
        assertSame($person, $person1);
        assertSame($person1, $person2);
    }

    public function testDependencyInjection()
    {
        // Pakai singleton agar tidak perlu membuat object baru terus-menerus
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);    // Ketika kita bikin/inject Bar, otomatis construction pada class Bar diinject object baru oleh Laravel

        assertNotSame($foo, $bar->foo);
    }
}
