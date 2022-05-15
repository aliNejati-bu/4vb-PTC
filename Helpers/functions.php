<?php


use JetBrains\PhpStorm\Pure;
use PTC\Classes\Messages;
use PTC\Classes\Redirect;
use PTC\Classes\Request;
use PTC\Classes\ViewEngine;

#[Pure] function redirect(string $target): Redirect
{
    return new Redirect($target);
}

function view(string $name, array $vars = []): ViewEngine
{
    return ViewEngine::getInstance($name, $vars);
}

/**
 * @return mixed
 */
function back(): mixed
{
    return $_SERVER["HTTP_REFERER"] ?? "javascript:history.go(-1)";
}

/**
 * @return array|mixed|string[]
 */
function errors(): array
{
    return Messages::getInstance()->errors;
}

/**
 * @param string $name
 * @param bool $default
 * @return mixed
 */
function error(string $name, bool $default = false): mixed
{
    return Messages::getInstance()->getError($name, $default);
}

function route($name, ...$params)
{
    if (!isset(\PTC\Classes\Config::getInstance()->getAllConfig('app')["routes"][$name])) {
        return '/';
    }
    $route = \PTC\Classes\Config::getInstance()->getAllConfig('app')["routes"][$name];
    foreach ($params as $param) {
        $route = str_replace("!-!", $param, $route);
    }
    return $route;
}

/**
 * @return bool
 */
function isError(): bool
{
    return Messages::getInstance()->isError();
}

/**
 * @return Request
 */
function request(): Request
{
    return Request::getInstance();
}