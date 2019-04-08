<?php

namespace App\Drink;


class Choco extends AbstractDrink implements DrinkInterface
{
    protected function getCode(): string
    {
        return 'H';
    }
}