<?php

namespace PTC\Classes;

use Firebase\JWT\JWT;
use PTC\App\Model\User;
use PTC\App\Model\UserSessionActivity;

class Auth
{
    /**
     * @var User|null
     */
    public ?User $userModel = null;

    /**
     * @param string $email
     * @param string $password
     * @param bool $isLong
     * @return bool
     */
    public function doLogin(string $email, string $password, bool $isLong = false): bool
    {
        $user = User::getUserByEmailAndPassword($email, $password);
        if (!$user) {
            return false;
        }
        $authConfig = Config::getInstance()->getAllConfig("auth");
        try {
            $key = $authConfig["jwt_key"];
            $iat = time();
            if ($isLong) {
                $exp = $iat + $authConfig["token_life_time_in_long"];
            } else {
                $exp = $iat + $authConfig["token_life_time"];
            }
            $payload = [
                'iat' => $iat,
                'exp' => $exp,
                'id' => $user->id
            ];
            $token = JWT::encode($payload, $key, 'HS256');

            $_SESSION[$authConfig["access_token_session_name"]] = $token;

            $session = UserSessionActivity::create(
                ["user_id" => $user->id, "token" => $token]
            );
            $_SESSION[$authConfig["id_session_name"]] = $session->id;
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

}