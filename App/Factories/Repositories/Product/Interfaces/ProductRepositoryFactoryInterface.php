<?php

namespace App\Factories\Repositories\Product\Interfaces;

use App\Repositories\Product\Interfaces\ProductRepositoryInterface;


interface ProductRepositoryFactoryInterface
{

    public function getProductRepository(): ProductRepositoryInterface;
}