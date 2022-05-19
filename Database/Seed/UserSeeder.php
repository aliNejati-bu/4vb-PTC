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
                "is_super_admin" => true,
                "is_admin" => true,
                "roles" => []
            ],[
                "user_email" => "test@gmail.com",
                "password" => "13811381my",
                "user_type" => 2,
                "is_email_verified" => true,
                "is_super_admin" => false,
                "is_admin" => true,
                "roles" => [1]
            ],
        ];

        foreach ($users as $user){
            $u = User::create($user);
            $u->roles()->attach($user["roles"]);
        }
    }
}