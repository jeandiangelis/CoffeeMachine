<?php

namespace App\Drink;


abstract class AbstractDrink implements DrinkInterface
{
    public const PROTOCOL_SEPARATOR = ':';

    /**
     * @var int
     */
    protected $sugarAmount;

    public function setSugarAmount(int $sugarAmount): void
    {
        if ($sugarAmount >= 0 && $sugarAmount < 3) {
            $this->sugarAmount = $sugarAmount;

            return;
        }

        throw new \InvalidArgumentException('Invalid sugar amount.');
    }

    protected function hasStick(): bool
    {
        return $this->sugarAmount > 0;
    }

    abstract protected function getCode(): string;

    public function __toString(): string
    {
        return implode([
            $this->getCode(),
            self::PROTOCOL_SEPARATOR,
            $this->formattedSugar(),
            self::PROTOCOL_SEPARATOR,
            $this->hasStick()
        ]);
    }

    private function formattedSugar(): string
    {
        return $this->sugarAmount > 0 ? $this->sugarAmount : '';
    }
}