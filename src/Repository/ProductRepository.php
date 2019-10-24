<?php
namespace App\Repository;

use App\Repository\MemoryStore\MemoryStore;
use App\Product\ProductInterface;
use App\Product\Product;

class ProductRepository implements
    ProductRepositoryInterface
{
    /**
     * @var MemoryStore
     */
    private $memoryStore;

    public function __construct(
        MemoryStore $memoryStore
    ) {
        $this->memoryStore = $memoryStore;
    }

    /**
     * @param string $sku
     * @return null|ProductInterface
     */
    public function find(string $sku): ?ProductInterface
    {
        $product = $this->memoryStore->$sku;

        if (!is_null($product)) {
            $product = (new Product($product))->setSku($sku);
        }

        return $product;
    }
}
