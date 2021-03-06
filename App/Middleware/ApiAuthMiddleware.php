<?php

namespace PTC\App\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use PTC\Classes\Auth;
use PTC\Classes\Config;
use PTC\Classes\Request;

class ApiAuthMiddleware implements \PTC\Boot\Interfaces\MiddlewareInterface
{

    /**
     * @inheritDoc
     */
    public function run()
    {
        $configs = Config::getInstance()->getAllConfig('auth');
        if (!isset(\request()->headers()["Authorization"])) {
            http_response_code(403);
            echo json_encode(responseJson(false, [], "token error."));
            die();
        }
        try {
            $token = explode(" ", \request()->headers()["Authorization"])[1];
            $payLoad = JWT::decode($token, new Key($configs["jwt_key"], $configs["jwt_alg"]));
            Request::getInstance()->auth = (new Auth())->createUSer($payLoad->id);
        } catch (\Throwable $e) {
            http_response_code(403);
            echo json_encode(responseJson(false, [], "token error."));
            die();
        }
    }
}