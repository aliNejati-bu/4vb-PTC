<?php

use Phroute\Phroute\RouteCollector;

/**
 * @var RouteCollector $router
 */


$router->controller(route("index"), \PTC\App\Controller\IndexController::class);

$router->get(route("panel"), function (){
   var_dump(request()->auth);
   10/0;
},["before"=>"authMiddleware"]);