<?php

namespace PTC\App\Controller\User\Slug;


use PTC\Classes\Config;
use PTC\Classes\Exception\ValidatorNotFoundException;
use PTC\Classes\Redirect;
use PTC\Classes\ViewEngine;

class SlugController
{
    public function getIndex(): ViewEngine
    {
        $slugs = auth()->userModel->slugs()->get();
        $randomString = getRandomString(6) . auth()->userModel->id;
        return view('panel>user>slug>index', compact("slugs", "randomString"));
    }

    /**
     * @return Redirect
     * @throws ValidatorNotFoundException
     */
    public function postIndex(): Redirect
    {
        request()->validatePostsAndFiles("createSlugValidator");
        try {
            $result = auth()->userModel->slugs()->create(request()->getValidated());
            if (!$result) {
                return \redirect(back())->with("error", "خطای ایجاد اسلاگ.");
            }
            return \redirect(back())->withMessage("created", "اسلاگ با موفقیت ایجاد شد.");
        } catch (\Throwable $exception) {
            return \redirect(back())->with("error", "خطای ناشناخته");
        }
    }


    /**
     * @return Redirect
     * @throws ValidatorNotFoundException
     */
    public function PostLink(): Redirect
    {
        request()->validatePostsAndFiles("createLinkValidator");
        if (str_contains(request()->getValidated()["target_link"], Config::getInstance()->getAllConfig("app")["app_url"])) {
            return \redirect(back())->with("error", "نمیتوانید لینک های کوتاه شده از مارا کوتاه کنید.");
        }
        try {
            $result = auth()->userModel->slugs()->where("id", request()->getValidated()["slug_id"])->first();
            if (!$result) {
                return \redirect(back())->with("error", "خطای ناشناخته در یافتن اسلاگ");
            }
            $pushResult = $result->links()->create(request()->getValidated());
            if (!$pushResult) {
                return \redirect(back())->with("error", "خطای ناشناخته در ایجاد لینک");
            }
            return \redirect(back())->withMessage("m", "اضافه کردن موفقیت آمیز بود.");
        } catch (\Throwable $exception) {
            return \redirect(back())->with("error", "خطای ناشناخته");
        }
    }
}

// TODO: فارسی کردن کلید خطا ها