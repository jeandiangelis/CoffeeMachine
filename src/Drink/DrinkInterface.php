<?php

namespace App\Drink;

interface DrinkInterface
{
    public const COFFEE = 'Coffee';
    public const TEA = 'Tea';
    public const CHOCOLATE = 'Choco';

    public function __toString(): string;
    public function setSugarAmount(int $sugarAmount): void;
}
