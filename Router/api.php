<?php

use Phroute\Phroute\RouteCollector;

/**
 * @var RouteCollector $router
 */

$router->get("/send-verify-code", function () {
    return (new \PTC\App\Controller\User\VerifyController())->generateVerifyCode();
}, ["before" => "apiAuthMiddleware"]);

$router->post("/add-phone", function () {
    return (new \PTC\App\Controller\User\VerifyController())->editPhoneNumber();
}, ["before" => "apiAuthMiddleware"]);