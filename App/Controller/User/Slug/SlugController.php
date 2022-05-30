<?php

namespace PTC\App\Controller\User\Slug;

use PTC\App\Model\Slug;
use PTC\Classes\Exception\ValidatorNotFoundException;
use PTC\Classes\Redirect;
use PTC\Classes\ViewEngine;

class SlugController
{
    public function getIndex(): ViewEngine
    {
        $slugs = auth()->userModel->slugs()->get();
        return view('panel>user>slug>index',compact("slugs"));
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
            return \redirect(back())->withMessage("created","اسلاگ با موفقیت ایجاد شد.");
        } catch (\Throwable $exception) {
            return \redirect(back())->with("error", "خطای ناشناخته");
        }
    }

}