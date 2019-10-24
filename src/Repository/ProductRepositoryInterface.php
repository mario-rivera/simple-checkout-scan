<?php
namespace App\Repository;

use App\Product\ProductInterface;

interface ProductRepositoryInterface
{
    /**
     * @param string $sku
     * @return null|ProductInterface
     */
    public function find(string $sku): ?ProductInterface;
}
