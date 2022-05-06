<?php

use Phroute\Phroute\RouteCollector;
use Illuminate\Database\Capsule\Manager as Capsule;

class Boot
{
    private static array $kernelOptions = [];

    public static function load()
    {
        self::generalBoot();
        self::BootDataBase();
        $router = new RouteCollector();

        self::PrepareMiddlewares($router);

        require_once BASE_DIR . DIRECTORY_SEPARATOR . "Router" . DIRECTORY_SEPARATOR . "web.php";

        $dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

        $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));


        if ($response instanceof \PTC\Classes\Redirect) {
            $response->exec();
        }
        echo $response;
    }

    public static function generalBoot()
    {
        spl_autoload_register(function ($class) {
            $class = str_replace('PTC\\', "", $class);
            $file = BASE_DIR . DIRECTORY_SEPARATOR .
                str_replace("\\", DIRECTORY_SEPARATOR, $class) . // replace \ in class namespace to DIRECTORY_SEPARATOR
                ".php";
            if (file_exists($file)) require_once $file;
        });

        require_once BASE_DIR . DIRECTORY_SEPARATOR . "Helpers" . DIRECTORY_SEPARATOR . "functions.php";
    }

    public static function BootDataBase()
    {

        $capsule = new Capsule;
        $dataBaseConfig = require_once BASE_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "database.php";

        $capsule->addConnection([

            "driver" => "mysql",

            "host" => $dataBaseConfig["server"],

            "database" => $dataBaseConfig["dbname"],

            "username" => $dataBaseConfig["username"],

            "password" => $dataBaseConfig["password"]

        ]);

        $capsule->setAsGlobal();

        $capsule->bootEloquent();
    }

    public static function PrepareMiddlewares(RouteCollector $router)
    {
        // get kernel options if not set
        if (self::$kernelOptions == []) {
            self::$kernelOptions = require_once BASE_DIR . DIRECTORY_SEPARATOR . "Boot" . DIRECTORY_SEPARATOR . "kernelOptions.php";
        }

        $middlewares = self::$kernelOptions["middleware"];
        foreach ($middlewares as $name => $middleware) {
            $middlewareInstance = new $middleware;
            $router->filter($name, [$middlewareInstance, "run"]);
        }
    }
}