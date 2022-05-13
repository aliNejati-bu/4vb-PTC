<?php

namespace PTC\App\Controller;

use PTC\Classes\Exception\ValidatorNotFoundException;
use PTC\Classes\Request;
use PTC\Classes\ViewEngine;

class IndexController
{
    public function getIndex(): ViewEngine
    {
        $name = "Welcome";
        return view("index", compact("name"));
    }

    public function getSignUp(): ViewEngine
    {
        $title = "ثبت نام";
        return view("auth>signUp", compact("title"));
    }

    /**
     * @throws ValidatorNotFoundException
     */
    public function postSignUp()
    {
        Request::getInstance()->validatePostsAndFiles("signUpValidator");

    }
}