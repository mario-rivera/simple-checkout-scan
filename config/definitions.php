<?php
use Psr\Container\ContainerInterface;

return [
    \Phroute\Phroute\RouteCollector::class => function(ContainerInterface $c){
        $router = new \Phroute\Phroute\RouteCollector;
        require_once(__DIR__ . "/routes.php");

        return $router;
    },
    \Phroute\Phroute\Dispatcher::class => function(
        \Phroute\Phroute\RouteCollector $router,
        \Lib\Router\RouterResolver $resolver
    ){
        return new Phroute\Phroute\Dispatcher($router->getData(), $resolver);
    },
    \Psr\Http\Message\ServerRequestInterface::class => function(){
        $request = (new \Jasny\HttpMessage\ServerRequest())->withGlobalEnvironment();
        return $request;
    },
    \Psr\Http\Message\ResponseInterface::class => function(){
        return new \Jasny\HttpMessage\Response;
    },
    \App\Repository\ProductRepositoryInterface::class => 
        \DI\autowire(\App\Repository\ProductRepository::class),
    \App\Product\ProductInterface::class =>
        \DI\autowire(\App\Product\Product::class),
];
