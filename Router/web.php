<?php

use Phroute\Phroute\RouteCollector;

/**
 * @var RouteCollector $router
 */


$router->controller(route("index"), \PTC\App\Controller\IndexController::class);
