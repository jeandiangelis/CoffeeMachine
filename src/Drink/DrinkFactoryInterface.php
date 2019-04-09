<?php

namespace App\Drink;

interface DrinkFactoryInterface
{
    public function make(): DrinkInterface;
}
