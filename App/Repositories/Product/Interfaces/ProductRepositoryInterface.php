<?php

namespace App\Repositories\Product\Interfaces;

use App\Values\Product;

interface ProductRepositoryInterface {

    /**
     * @return Product[]
     */
    public function getAll():array;
}