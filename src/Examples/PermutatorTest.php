<?php

namespace App\Examples;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class PermutatorTest extends TestCase
{
    /** @var Permutator */
    protected $sut;

    public function provideData()
    {
        return [
            '3tokens' => [
                'input' => 'foo bar baz',
                'expectation'  => [
                    'bar baz foo',
                    'baz bar foo',
                    'bar foo baz',
                    'baz foo bar'
                ]
            ],
            '4tokens' => [
                'input' => 'foo1 foo2 foo3 foo4',
                'expectation' => [
                    'foo2 foo1 foo3 foo4',
                    'foo2 foo1 foo4 foo3',
                    'foo2 foo3 foo1 foo4',
                    'foo2 foo3 foo4 foo1',
                    'foo2 foo4 foo1 foo3',
                    'foo2 foo4 foo3 foo1',

                    'foo3 foo1 foo2 foo4',
                    'foo3 foo1 foo4 foo2',
                    'foo3 foo2 foo1 foo4',
                    'foo3 foo2 foo4 foo1',
                    'foo3 foo4 foo1 foo2',
                    'foo3 foo4 foo2 foo1',

                    'foo4 foo1 foo2 foo3',
                    'foo4 foo1 foo3 foo2',
                    'foo4 foo2 foo1 foo3',
                    'foo4 foo2 foo3 foo1',
                    'foo4 foo3 foo1 foo2',
                    'foo4 foo3 foo2 foo1',
                ],
            ],
            'multipleSpaces' => [
                'input' => 'foo  bar  baz',
                'expectation'  => [
                    'bar baz foo',
                    'baz bar foo',
                    'bar foo baz',
                    'baz foo bar'
                ]
            ],
            'doesnt allow shorter repeating words on first position' => [
                'input' => 'nike+ nike',
                'expectation' => [],
            ],
            'allows longer words with similar beginning at first place' => [
                'input' => 'rasen rasenmäher',
                'expectation' => [
                    'rasenmäher rasen',
                ],
            ],
            'handles leading and trailing space' => [
                'input' => ' foo bar ',
                'expectation' => [
                    'bar foo',
                ],
            ],
        ];

    }

    protected function setUp()
    {
        $this->sut = new Permutator(new Tokenizer());
    }

    /**
     * @dataProvider provideData
     */
    public function testShingleTerm($input, $expectation)
    {
        sort($expectation);
        $builtPermutation = $this->sut->buildPermutations($input);
        sort($builtPermutation);
        $this->assertEquals($expectation, $builtPermutation);
    }

    public function testOneToken()
    {
        $permutation = $this->sut->buildPermutations('abc');
        $this->assertNull($permutation);
    }

    public function testTokenLimit()
    {
        $this->assertNull($this->sut->buildPermutations('abc abd abe as asd awe'));
    }
}
