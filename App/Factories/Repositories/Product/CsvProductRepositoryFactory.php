<?php

namespace App\Factories\Repositories\Product;

use App\Factories\Repositories\Product\Interfaces\ProductRepositoryFactoryInterface;
use App\Repositories\Product\CSVProductRepository;
use App\Repositories\Product\Interfaces\ProductRepositoryInterface;

class CsvProductRepositoryFactory extends ProductRepositoryFactory implements ProductRepositoryFactoryInterface {


    public function getProductRepository(): ProductRepositoryInterface
    {
        return new CSVProductRepository($this->dbPool->get('csv'));
    }
}