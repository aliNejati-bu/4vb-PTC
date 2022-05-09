<?php

namespace PTC\Database\Seed;

use PTC\App\Model\User;

class UserSeeder
{
    public static function Seed()
    {
        $users = [
            [
                "user_email" => "electrocellco@gmail.com",
                "password" => "13811381my",
                "user_type" => 2,
                "is_email_verified" => true,
                "is_super_admin" => true
            ],
        ];

        foreach ($users as $user){
            User::create($user);
        }
    }
}