<?php

namespace App\Drink;


class Tea extends AbstractDrink implements DrinkInterface
{
    protected function getCode(): string
    {
        return 'T';
    }
}