<?php

namespace PTC\App\Controller;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use PTC\App\Model\User;
use PTC\Classes\Exception\ValidatorNotFoundException;
use PTC\Classes\Redirect;
use PTC\Classes\Request;
use PTC\Classes\ViewEngine;

class IndexController
{
    public function getIndex(): ViewEngine
    {
        $key = "iv";
        $payload = [
            'iat' => time(),
            'exp' => time() + 10
        ];
        $jwt = JWT::encode($payload, $key, 'HS256');


        $name = $jwt;
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

        // TODO:: برسی فعال بودن تیک قوانین ما
    }

    /**
     * @return ViewEngine
     */
    public function getLogin(): ViewEngine
    {
        $title = "ورود";
        return view("auth>login", compact("title"));
    }


    /**
     * @throws ValidatorNotFoundException
     */
    public function postLogin()
    {
        request()->validatePostsAndFiles("auth" . DIRECTORY_SEPARATOR . "loginValidator");
        $user = User::getUserByEmailAndPassword(request()->getValidated()["email"], request()->getValidated()["password"]);
        if (!$user) {
            return \redirect(back())->with("error", "نام کاربری و رمز عبور همخوانی ندارد.");
        }
    }


}