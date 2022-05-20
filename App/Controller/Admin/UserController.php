<?php

namespace PTC\App\Controller\Admin;

class UserController
{
    public function __construct()
    {
        if (!(auth()->userModel->isSuperAdmin() || auth()->userModel->hasPermission("Users"))){

        }
    }
}