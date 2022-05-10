<?php

use Phroute\Phroute\RouteCollector;

/**
 * @var RouteCollector $router
 */

$router->get("/", function () {
    var_dump(\PTC\Classes\Mail::getInstance()->send(["electrocellco9@gmail.com"], "test Email", "PHP MAILER", "hi ali", "html not supported,"));
    die();
    $name = "Welcome";
    return view("index", compact("name"));
});