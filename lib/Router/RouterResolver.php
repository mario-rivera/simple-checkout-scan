<?php
namespace Lib\Router;

use Phroute\Phroute\HandlerResolverInterface;
use Psr\Container\ContainerInterface;

class RouterResolver implements HandlerResolverInterface
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

    public function resolve($handler)
    {
        /*
         * Only attempt resolve uninstantiated objects which will be in the form:
         *
         *      $handler = ['App\Controllers\Home', 'method'];
         */
        if(is_array($handler) && is_string($handler[0]))
        {
            $handler[0] = $this->container->get($handler[0]);
        }

        return $handler;
    }
}
