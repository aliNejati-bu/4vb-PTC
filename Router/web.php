<?php

use Phroute\Phroute\RouteCollector;
use PTC\App\Controller\PanelController;

/**
 * @var RouteCollector $router
 */


$router->controller(route("index"), \PTC\App\Controller\IndexController::class);

$router->get(route("panel"), function () {
    return (new PanelController)->index();
}, ["before" => "authMiddleware"]);