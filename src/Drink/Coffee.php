<?php

namespace App\Drink;


class Coffee extends AbstractDrink implements DrinkInterface
{
    protected function getCode(): string
    {
        return 'C';
    }
}