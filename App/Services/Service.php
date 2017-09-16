<?php

namespace App\Services;


use Pimple\Container;

abstract class Service
{
    protected $dic;

    public function __construct(Container $container)
    {
        $this->dic = $container;
    }
}