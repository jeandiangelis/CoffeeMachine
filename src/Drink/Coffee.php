<?php

namespace App\Drink;

class Coffee extends AbstractDrink
{
    protected function getCode(): string
    {
        return 'C';
    }
}
