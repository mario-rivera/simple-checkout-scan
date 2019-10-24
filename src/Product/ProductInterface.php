<?php
namespace App\Product;

interface ProductInterface
{
    /**
     * @return string
     */
    public function getSku(): string;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return float
     */
    public function getPrice(): float;

    /**
     * @param float $price
     * @return self
     */
    public function setPrice(float $price);
}
