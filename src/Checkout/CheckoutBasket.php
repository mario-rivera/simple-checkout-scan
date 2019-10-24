<?php
namespace App\Checkout;

use App\Product\ProductInterface;

class CheckoutBasket
{
    /**
     * @var array
     */
    private $products = [];

    public function add(ProductInterface $product)
    {
        if (!array_key_exists($product->getSku(), $this->products)) {
            $this->products[$product->getSku()] = [];
        }

        $this->products[$product->getSku()][] = $product;
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param string $sku
     * @return ProductInterface[]
     */
    public function getProductsBySku(string $sku): array
    {
        return array_key_exists($sku, $this->products) ? $this->products[$sku] : [];
    }
}
