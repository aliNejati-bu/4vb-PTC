<?php

return [
    // add middleware to kernel
    'middleware' => [
        'exampleMiddleware' => \PTC\App\Middleware\ExampleMiddleware::class,
        'authMiddleware' => \PTC\App\Middleware\AuthMiddleware::class
    ]
];
