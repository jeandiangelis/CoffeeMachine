<?php
/**
 * Created by PhpStorm.
 * User: romanmoroz
 * Date: 2019-04-08
 * Time: 17:36
 */

namespace App\Tests;

use App\Drink\DrinkFactory;
use PHPUnit\Framework\TestCase;

class ChocoTest extends TestCase
{
    public function cases()
    {
        yield 'Test with choco no sugar and no stick' => ['Choco', 'H::'];
    }

    /**
     * @dataProvider cases
     */
    public function testToString($case, $expected)
    {
        $factory = new DrinkFactory($case);

        $this->assertEquals($expected, (string) $factory->make());
    }

}
