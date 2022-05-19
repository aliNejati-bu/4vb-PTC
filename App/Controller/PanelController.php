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
        $currentPage = "panel";
        return view("panel>panel",compact("currentPage"));
    }
}