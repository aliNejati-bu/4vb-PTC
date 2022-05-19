<?php

namespace PTC\App\Controller;

use PTC\Classes\ViewEngine;

class PanelController
{

    /**
     * @return ViewEngine
     */
    public function index(): ViewEngine
    {
        var_dump(auth()->userModel->hasPermission("Users"));
        die();
        return view("panel>panel");
    }
}