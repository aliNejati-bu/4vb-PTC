<?php

use Phroute\Phroute\RouteCollector;

/**
 * @var RouteCollector $router
 */

$router->get("/", function () {
    $res = \PTC\Classes\Validator\Validator::getInstance()->makeFromValidator($_FILES + $_POST,"testValidator");
    $res = $res->validate();
    var_dump($res->errors()->firstOfAll());
    die();
    $name = "Welcome";
    return view("index", compact("name"));
});