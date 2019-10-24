<?php
namespace App\Product;

interface ProductInterface
{
    public function getSku(): string;
    public function getName(): string;
    public function getPrice(): float;
    public function setPrice(float $price);
}
