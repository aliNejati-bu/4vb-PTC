<?php

use Phroute\Phroute\RouteCollector;

/**
 * @var RouteCollector $router
 */

$router->get("/", function () {
    $name = "Welcome";
    return view("index", compact("name"));
});


$router->get("/test",function (){
    return redirect(route("index"));
});

