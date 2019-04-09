<?php

namespace App\Drink;

class Tea extends AbstractDrink
{
    protected function getCode(): string
    {
        return 'T';
    }
}
