<?php
namespace App\Product;

class Product implements
    ProductInterface
{
    /**
     * @var string
     */
    private $sku;

    /**
     * @var array
     */
    private $data;

    public function __construct(
        array $data
    ) {
        $this->data = $data;  
    }

    /**
     * @param string $sku
     * @return self
     */
    public function setSku(string $sku)
    {
        $this->sku = $sku;
        return $this;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->data['name'];
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->data['price'];
    }

    /**
     * @param float $price
     * @return self
     */
    public function setPrice(float $price)
    {
        $this->data['price'] = $price;
        return $this;
    }
}
