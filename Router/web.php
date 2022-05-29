<?php

use Phroute\Phroute\RouteCollector;
use PTC\App\Controller\PanelController;

/**
 * @var RouteCollector $router
 */


$router->controller(route("index"), \PTC\App\Controller\IndexController::class);

$router->group(["before" => ["authMiddleware"], "prefix" => route("panel")], function (RouteCollector $router) {
    $router->get("/", function () {
        return (new PanelController)->index();
    });
    $router->controller("/user", \PTC\App\Controller\Admin\UserController::class,
        ["before" =>
            ["onlyVerifyPhone"],
        ]
    );


    $router->get("/verify-phone", function () {
        return (new \PTC\App\Controller\User\VerifyController())->verifyCodeView();
    });


    $router->controller('/slug', \PTC\App\Controller\User\Slug\SlugController::class);

});

