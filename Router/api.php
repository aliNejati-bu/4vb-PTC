<?php

use Phroute\Phroute\RouteCollector;

/**
 * @var RouteCollector $router
 */

$router->controller("/verify-phone",\PTC\App\Controller\user\VerifyController::class);