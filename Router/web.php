<?php

use Phroute\Phroute\RouteCollector;

/**
 * @var RouteCollector $router
 */

$router->get("/", function () {
    \PTC\Classes\Request::getInstance()->validatePostsAndFiles("testValidator");
    $name = "Welcome";
    return view("index", compact("name"));
});
