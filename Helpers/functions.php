<?php


use JetBrains\PhpStorm\Pure;

#[Pure] function redirect(string $target):\PTC\Classes\Redirect{
    return new \PTC\Classes\Redirect($target);
}