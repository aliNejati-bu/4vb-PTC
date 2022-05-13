<?php

namespace PTC\App\Controller;

class IndexController
{
    public function getIndex(): \PTC\Classes\ViewEngine
    {
        $name = "Welcome";
        return view("index", compact("name"));
    }

    public function getSignUp()
    {
        return view("auth>signUp");
    }
}