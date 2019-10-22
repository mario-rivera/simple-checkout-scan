<?php
require_once(dirname(__DIR__) . "/vendor/autoload.php");

$builder = new \DI\ContainerBuilder();
$builder->addDefinitions( __DIR__ . "/definitions.php");

$container = $builder->build();
