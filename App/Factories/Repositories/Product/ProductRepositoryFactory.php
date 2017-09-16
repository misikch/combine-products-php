<?php

namespace App\Factories\Repositories\Product;


use App\Databases\DBPool\DBPool;

class ProductRepositoryFactory
{
    protected $dbPool;

    public function __construct(DBPool $dbPool)
    {
        $this->dbPool = $dbPool;
    }
}