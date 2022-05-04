<?php

use Phroute\Phroute\RouteCollector;

class Boot
{
    public static function load()
    {
        spl_autoload_register(function ($class) {
            $class = str_replace('PTC\\', "", $class);
            $file = BASE_DIR . DIRECTORY_SEPARATOR .
                str_replace("\\", DIRECTORY_SEPARATOR, $class) . // replace \ in class namespace to DIRECTORY_SEPARATOR
                ".php";
            if (file_exists($file)) require_once $file;
        });

        $router = new RouteCollector();

        require_once BASE_DIR . DIRECTORY_SEPARATOR . "Router" . DIRECTORY_SEPARATOR . "web.php";

        $dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

        $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        echo $response;
    }
}