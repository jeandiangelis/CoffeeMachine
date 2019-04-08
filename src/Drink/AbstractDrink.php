<?php

namespace App\Drink;


abstract class AbstractDrink implements DrinkInterface
{
    /**
     * @var int
     */
    protected $sugarAmount;

    /**
     * @param int $sugarAmount
     */
    public function setSugarAmount(int $sugarAmount): void
    {
        $this->sugarAmount = $sugarAmount;
    }

    protected function hasStick(): bool
    {
        return $this->sugarAmount > 0;
    }

    protected abstract function getCode(): string;

    public function __toString(): string
    {
        return sprintf('%s:%s:%s', $this->getCode(),$this->sugarAmount ?: '', $this->hasStick()) ?: '';
    }
}