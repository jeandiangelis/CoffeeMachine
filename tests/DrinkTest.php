<?php

namespace App\Tests;

use App\Drink\DrinkFactory;
use PHPUnit\Framework\TestCase;

class DrinkTest extends TestCase
{
    public function invalidSugarCase()
    {
        yield 'Test with with -1 sugar' => ['Choco', -1];
        yield 'Test with with 5 sugar' => ['Coffee', 5];
        yield 'Test with with 3 sugar' => ['Tea', 3];
    }


    public function validCases()
    {
        yield 'Test with choco no sugar and no stick' => ['Choco', 0, 'H::'];
        yield 'Test with tea no sugar and no stick' => ['Tea', 0, 'T::'];
        yield 'Test with coffee no sugar and no stick' => ['Coffee', 0, 'C::'];
        yield 'Test with choco with 1 sugar' => ['Choco', 1, 'H:1:1'];
        yield 'Test with coffee with 1 sugar' => ['Coffee', 1, 'C:1:1'];
        yield 'Test with choco with 2 sugar' => ['Choco', 2, 'H:2:1'];
    }

    /**
     * @dataProvider validCases
     */
    public function testValidToString($type, $sugar, $expected)
    {
        $factory = new DrinkFactory($type);

        $this->assertEquals($expected, (string) $factory->make($sugar));
    }

    /**
     * @dataProvider invalidSugarCase
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidSugar($type, $sugar)
    {
        $factory = new DrinkFactory($type);
        $drink = $factory->make();

        $drink->setSugarAmount($sugar);
    }
}
