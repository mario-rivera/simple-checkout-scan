<?php

$router->get('/example/one', [\App\Controller\SampleController::class, 'getOne']);
$router->get('/example/two', [\App\Controller\SampleController::class, 'getTwo']);
$router->get('/example/three', [\App\Controller\SampleController::class, 'getThree']);