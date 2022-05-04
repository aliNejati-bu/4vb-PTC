<?php

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('users', function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->string("app");
    $blueprint->timestamps();;
});

