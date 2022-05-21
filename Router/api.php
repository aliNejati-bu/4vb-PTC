<?php

use Phroute\Phroute\RouteCollector;

/**
 * @var RouteCollector $router
 */

$router->get("/",function (){
   return "ok";
});