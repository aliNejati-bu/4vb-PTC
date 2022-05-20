<?php

namespace PTC\App\Controller\Admin;

use PTC\Classes\Exception\ViewNotFoundedException;

class UserController
{
    /**
     * @throws ViewNotFoundedException
     */
    public function __construct()
    {
        if (!(auth()->userModel->isSuperAdmin() || auth()->userModel->hasPermission("Users"))) {
            $result = view(get404ViewName())->render();
            http_response_code(404);
            echo $result;
        }
    }

    public function getIndex()
    {
        $currentPage = "panel";
        $currentSubMenu = "index";
        return view("panel>user>index",compact("currentPage","currentSubMenu"));
    }
}