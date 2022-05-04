<?php

namespace PTC\Database\Seed;

use PTC\App\Model\User;

class UserSeeder
{
    public static function Seed()
    {
        User::create([
            "app" => "ali"
        ]);
    }
}