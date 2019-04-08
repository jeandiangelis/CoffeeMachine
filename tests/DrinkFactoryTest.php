<?php

namespace App\Tests;

use App\Drink\Choco;
use App\Drink\Coffee;
use App\Drink\DrinkFactory;
use App\Drink\Tea;
use PHPUnit\Framework\TestCase;

class DrinkFactoryTest extends TestCase
{
    public function testMakeCoffee()
    {
        $factory = new DrinkFactory('Coffee');

        $this->assertInstanceOf(Coffee::class, $factory->make());
    }

    public function testMakeTea()
    {
        $factory = new DrinkFactory('Tea');

        $this->assertInstanceOf(Tea::class, $factory->make());
    }

    public function testMakeChoco()
    {
        $factory = new DrinkFactory('Choco');

        $this->assertInstanceOf(Choco::class, $factory->make());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidType()
    {
        $factory = new DrinkFactory('Vodka');

        $factory->make();
    }
}
