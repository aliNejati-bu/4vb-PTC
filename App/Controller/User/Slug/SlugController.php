<?php

namespace PTC\App\Controller\User\Slug;

use PTC\Classes\ViewEngine;

class SlugController
{
    public function getIndex(): ViewEngine
    {
        return view('panel>user>slug>index');
    }
}