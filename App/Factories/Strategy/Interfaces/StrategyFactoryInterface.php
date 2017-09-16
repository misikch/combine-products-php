<?php

namespace App\Factories\Strategy\Interfaces;


use App\Strategy\Interfaces\StrategyInterface;

interface StrategyFactoryInterface
{
    public function getStrategy(): StrategyInterface;
}