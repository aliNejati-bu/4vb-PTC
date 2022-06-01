<?php

use Phroute\Phroute\RouteCollector;
use PTC\App\Controller\PanelController;

/**
 * @var RouteCollector $router
 */


$router->controller(route("index"), \PTC\App\Controller\IndexController::class);

$router->get("panel/verify-phone", function () {
    return (new \PTC\App\Controller\User\VerifyController())->verifyCodeView();
}, ["before" => ["authMiddleware"]]);

$router->group(["before" => ["authMiddleware", "onlyVerifyPhone"], "prefix" => route("panel")], function (RouteCollector $router) {
    $router->get("/", function () {
        return (new PanelController)->index();
    });
    $router->controller("/user", \PTC\App\Controller\Admin\UserController::class
    );

    $router->controller('/slug', \PTC\App\Controller\User\Slug\SlugController::class);

});

$router->controller("/", \PTC\App\Controller\Link\OpenLinkController::class);
