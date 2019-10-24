<?php
namespace App\Repository;

use App\Product\ProductInterface;

interface ProductRepositoryInterface
{
    public function find(string $sku): ?ProductInterface;
}
