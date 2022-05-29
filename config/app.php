<?php


return [
    'lang' => 'fa',
    'app_url' => 'http://192.168.1.19:8000',
    'routes' => [
        'index' => '/',
        'signup' => "/sign-up",
        'login' => '/login',
        'panel' => '/panel',
        'userList' => '/panel/user',
        'apiAddPhone' => "/api/add-phone",
        'apiSendVerifyPhone' => '/api/send-verify-code',
        'apiVerifyPhoneCode' => "/api/verify-phone",
        'verifyPhone' => '/panel/verify-phone',

        // user routes.
        'addSlug' => '/panel/slug'
    ],
];