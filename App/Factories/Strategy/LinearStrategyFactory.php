<?php

namespace App\Factories\Strategy;


use App\Factories\Strategy\Interfaces\StrategyFactoryInterface;
use App\Strategy\Adapters\LinearStrategyAdapter;
use App\Strategy\Interfaces\StrategyInterface;
use App\Strategy\LinearStrategy;

class LinearStrategyFactory implements StrategyFactoryInterface
{
    public function getStrategy(): StrategyInterface
    {
       return new LinearStrategyAdapter(new LinearStrategy());
    }
}