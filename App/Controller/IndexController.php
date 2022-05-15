<?php

namespace PTC\App\Controller;

use PTC\App\Model\User;
use PTC\Classes\Exception\ValidatorNotFoundException;
use PTC\Classes\Redirect;
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
     * @return Redirect
     * @throws ValidatorNotFoundException
     */
    public function postSignUp(): Redirect
    {
        Request::getInstance()->validatePostsAndFiles("signUpValidator");

        $user = User::create(request()->getValidated());
        if ($user) {
            return redirect(route('login'))->withMessage("login", "ورود با موفقیت انجام شد.");
        }
        return redirect(back())->with("error", "متاسفانه کاربر ایجاد نشد.");
    }

    public function getLogin()
    {
        return "login";
    }
}