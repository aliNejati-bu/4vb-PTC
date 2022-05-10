<?php


use JetBrains\PhpStorm\Pure;
use PTC\Classes\Redirect;
use PTC\Classes\ViewEngine;

#[Pure] function redirect(string $target): Redirect
{
    return new Redirect($target);
}

function view(string $name, array $vars = []): ViewEngine
{
    return ViewEngine::getInstance($name, $vars);
}