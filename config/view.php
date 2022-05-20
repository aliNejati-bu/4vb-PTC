<?php


/*
 * view configs
 */
return [

    // base directory for views
    "baseViewDirectory" => BASE_DIR . DIRECTORY_SEPARATOR . "views",

    // default variables passed to views
    "default_variables" => [
        "base" => BASE_DIR . DIRECTORY_SEPARATOR . "views",
        "dirSep" => DIRECTORY_SEPARATOR
    ],
    "404" => "err>404"
];