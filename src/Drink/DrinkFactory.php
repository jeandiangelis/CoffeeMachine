<?php

namespace App\Drink;

class DrinkFactory
{
    /**
     * @var string
     */
    private $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function make(int $sugarAmount = 0): DrinkInterface
    {
        $drink = $this->typeToClass();
        $drink->setSugarAmount($sugarAmount);

        return $drink;
    }

    private function typeToClass(): AbstractDrink
    {
        $classmap = [
            'Choco'     => new Choco(),
            'Tea'       => new Tea(),
            'Coffee'    => new Coffee(),
        ];

        if (in_array($this->type, array_keys($classmap))) {
            return $classmap[$this->type];
        }

        throw new \InvalidArgumentException(sprintf('Type of drink %s is not valid.', $this->type));
    }
}