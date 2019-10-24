<?php
namespace App\Repository\MemoryStore;

class MemoryStore
{
    /**
     * @var array
     */
    private $store;

    public function __construct()
    {
        $this->loadStore(__DIR__ . '/products.json');
    }

    /**
     * @param string $file
     * @return self
     */
    public function loadStore(string $file)
    {
        $json = file_get_contents($file);
        $this->setStore(json_decode($json, true));

        return $this;
    }

    /**
     * @param array $store
     * @return self
     */
    public function setStore(array $store)
    {
        $this->store = $store;
        return $this;
    }

    /**
     * @param string $sku
     * @return array|null
     */
    public function __get(string $sku)
    {
        return array_key_exists($sku, $this->store) ? $this->store[$sku] : null;
    }
}
