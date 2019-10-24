<?php
namespace App\Checkout;

use App\Checkout\PricingRules\PricingRules;
use App\Repository\ProductRepositoryInterface;

class Checkout
{
    /**
     * @var CheckoutBasket
     */
    private $checkoutBasket;

    /**
     * @var PricingRules
     */
    private $pricingRules;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    public function __construct(
        CheckoutBasket $checkoutBasket,
        PricingRules $pricingRules,
        ProductRepositoryInterface $productRepository
    ) {
        $this->checkoutBasket = $checkoutBasket;
        $this->pricingRules = $pricingRules;
        $this->productRepository = $productRepository;
    }

    /**
     * @param string $sku
     * @return self
     */
    public function scan(string $sku)
    {
        $product = $this->productRepository->find($sku);
        if (is_null($product)) {
            throw new \RuntimeException("Unable to locate article in database.");
        }

        $this->checkoutBasket->add($product);

        return $this;
    }

    /**
     * @return float
     */
    public function total(): float
    {
        $total = 0;
        $this->pricingRules->applyRules($this->checkoutBasket);

        foreach ($this->checkoutBasket->getProducts() as $sku => $products) {
            foreach($products as $product) {
                $total += $product->getPrice();
            }
        }

        return $total;
    }

    /**
     * @param array $skus
     * @return self
     */
    public function bulkScan(array $skus)
    {
        foreach ($skus as $sku) {
            $this->scan($sku);
        }

        return $this;
    }
}
