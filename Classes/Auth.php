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
    }

    private function setCookieAndSessions(User $user)
    {
        
    }
}