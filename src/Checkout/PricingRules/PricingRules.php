<?php
namespace App\Checkout\PricingRules;

use App\Checkout\CheckoutBasket;
use App\Repository\ProductRepositoryInterface;

class PricingRules
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository
    ) {
        $this->productRepository = $productRepository;
    }
    public function applyRules(CheckoutBasket $checkoutBasket)
    {
        foreach ($checkoutBasket->getProducts() as $sku => $products) {
            switch ($sku) {
                case 'atv':
                    $this->applyAtvRules($products);
                    break;
                case 'ipd':
                    $this->applyIpadRules($products);
                    break;
                case 'mbp':
                    $this->applyMacProRules($products, $checkoutBasket);
                    break;

            }
        }
    }

    /**
     * @param ProductRepositoryInterface[]
     */
    public function applyAtvRules(array $products)
    {
        $discountCount = 0;

        foreach ($products as $product) {
            ++$discountCount;

            if ($discountCount === 3) {
                $product->setPrice(0);
                $discountCount = 0;
            }
        }
    }

    /**
     * @param ProductRepositoryInterface[]
     */
    public function applyIpadRules(array $products)
    {
        $ipad = $this->productRepository->find('ipd');

        $productPrice = $ipad->getPrice();
        if (count($products) > 4) {
            $productPrice = 499.99;
        }

        foreach ($products as $product) {

            $product->setPrice($productPrice);
        }
    }

    /**
     * @param ProductRepositoryInterface[]
     */
    public function applyMacProRules(array $products, CheckoutBasket $checkoutBasket)
    {
        $vgaInBasket = $checkoutBasket->getProductsBySku('vga');

        foreach ($products as $product) {
            if (!empty($vgaInBasket)) {
                $vga = array_pop($vgaInBasket);
                $vga->setPrice(0);
            } else {
                $vga = $this->productRepository->find('vga');
                $vga->setPrice(0);
                $checkoutBasket->add($vga);
            }

        }
    }
}
