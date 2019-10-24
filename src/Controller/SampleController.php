<?php
namespace App\Controller;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use App\Checkout\Checkout;

class SampleController
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Checkout
     */
    private $checkout;

    public function __construct(
        ContainerInterface $container,
        Checkout $checkout
    ) {
        $this->container = $container;
        $this->checkout = $checkout;
    }

    public function getOne()
    {
        $productsToScan = ['atv', 'atv', 'atv', 'vga'];
        $this->checkout->bulkScan($productsToScan);

        $total = $this->checkout->total();

        $response = $this->container->get(ResponseInterface::class);
        $response->getBody()->write("Total for (" . implode(",", $productsToScan) . ") is {$total}". PHP_EOL);
        return $response->withStatus(200);
    }

    public function getTwo()
    {
        $productsToScan = ['atv', 'ipd', 'ipd', 'atv', 'ipd', 'ipd', 'ipd'];
        $this->checkout->bulkScan($productsToScan);

        $total = $this->checkout->total();

        $response = $this->container->get(ResponseInterface::class);
        $response->getBody()->write("Total for (" . implode(",", $productsToScan) . ") is {$total}". PHP_EOL);
        return $response->withStatus(200);
    }

    public function getThree()
    {
        $productsToScan = ['mbp', 'vga', 'ipd'];
        $this->checkout->bulkScan($productsToScan);

        $total = $this->checkout->total();

        $response = $this->container->get(ResponseInterface::class);
        $response->getBody()->write("Total for (" . implode(",", $productsToScan) . ") is {$total}" . PHP_EOL);
        return $response->withStatus(200);
    }
}
