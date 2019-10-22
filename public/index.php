<?php
require_once(dirname(__DIR__ ) . "/config/bootstrap.php");

$dispatcher = $container->get(\Phroute\Phroute\Dispatcher::class);
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$emitter = $container->get(\Jasny\HttpMessage\Emitter::class);
$emitter->emit($response);