<?php

namespace App\Drink;

class DrinkFactory implements DrinkFactoryInterface
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
            DrinkInterface::CHOCOLATE   => new Choco(),
            DrinkInterface::TEA         => new Tea(),
            DrinkInterface::COFFEE      => new Coffee(),
        ];

        if (array_key_exists($this->type, $classmap)) {
            return $classmap[$this->type];
        }

        throw new \InvalidArgumentException(sprintf('Type of drink %s is not valid.', $this->type));
    }
}
