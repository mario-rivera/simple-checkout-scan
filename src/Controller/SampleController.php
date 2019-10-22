<?php
namespace App\Controller;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class SampleController
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(
        ContainerInterface $container
    ) {
        $this->container = $container;
    }

    public function getExample()
    {
        $request = $this->container->get(ServerRequestInterface::class);
        $response = $this->container->get(ResponseInterface::class);

        $response->getBody()->write('This route responds to requests with the GET method at the path /example');
        return $response->withStatus(200);
    }
}
