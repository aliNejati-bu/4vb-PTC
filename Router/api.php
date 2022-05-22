<?php

use Phroute\Phroute\RouteCollector;

/**
 * @var RouteCollector $router
 */

$router->get("/verify-phone", function () {
    return (new \PTC\App\Controller\user\VerifyController())->generateVerifyCode();
});