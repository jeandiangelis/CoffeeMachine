<?php

namespace App\Tests;

use App\Drink\Choco;
use App\Drink\Coffee;
use App\Drink\DrinkFactory;
use App\Drink\Tea;
use PHPUnit\Framework\TestCase;

class DrinkFactoryTest extends TestCase
{
    public function invalidTypes()
    {
        yield 'Invalid random string' => ['INVALID_RANDOM_STRING'];
        yield 'Invalid Tea(no ucfirst)' => ['tea'];
        yield 'Invalid Coffee(space in between chars)' => ['c o f f e e'];
        yield 'Invalid Choco(typo choco)' => ['chocoo'];
    }

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
     * @dataProvider invalidTypes
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidType($type)
    {
        $factory = new DrinkFactory($type);

        $factory->make();
    }
}
