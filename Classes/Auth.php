<?php

namespace PTC\Classes;

use PTC\App\Model\User;

class Auth
{
    public function doLogin(string $email, string $password): bool
    {
        $user = User::getUserByEmailAndPassword($email, $password);
        if (!$user) {
            return false;
        }
        $authConfig = Config::getInstance()->getAllConfig("auth");

    }

    private function setCookieAndSessions(User $user)
    {
        
    }
}