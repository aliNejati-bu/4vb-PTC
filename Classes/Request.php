<?php

namespace PTC\Classes;

class Request
{
    /**
     * @return array
     */
    public function allPost(): array
    {
        return $_POST + $_FILES;
    }
}