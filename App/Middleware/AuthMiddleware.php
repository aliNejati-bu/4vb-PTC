<?php

namespace PTC\App\Middleware;

use PTC\Classes\Config;

class AuthMiddleware implements \PTC\Boot\Interfaces\MiddlewareInterface
{

    /**
     * @inheritDoc
     */
    public function run()
    {
        $configs = Config::getInstance()->getAllConfig('auth');
        if (!isset($_SESSION['access_token_session_name'])){
            redirect(route('login'))->withMessage('error','برای درسترسی به پنل باید وارد شده باشد.')->exec();
        }
    }
}