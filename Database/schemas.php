<?php

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('users', function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->string("user_email")->unique();
    $blueprint->string("password");
    $blueprint->string("phone")->nullable()->unique();
    /*
     * user type for present type of user account
     * 0: common
     * 1: silver
     * 2: gold
     */
    $blueprint->enum("user_type", [0, 1, 2])->default(0);
    $blueprint->boolean("is_phone_verified")->default(false);
    $blueprint->boolean("is_email_verified")->default(false);
    $blueprint->boolean("is_super_admin")->default(false);
    $blueprint->boolean("is_admin")->default(false);
    $blueprint->string("name");
    $blueprint->timestamps();;
});

Capsule::schema()->create('phone_codes', function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->string("code");
    $blueprint->dateTime("expire_at");
    $blueprint->boolean("is_usesd");
    $blueprint->bigInteger("user_id")->unsigned();
    $blueprint->boolean("is_available")->default(true);
    $blueprint->timestamps();
    $blueprint->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
});

Capsule::schema()->create('email_links', function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->string("slug")->unique();
    $blueprint->dateTime('expire_at');
    $blueprint->boolean('is_used');
    $blueprint->bigInteger("user_id")->unsigned();
    $blueprint->timestamps();
    $blueprint->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
});

Capsule::schema()->create('slugs', function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->string("slug")->unique();
    $blueprint->boolean("is_direct")->default(false);
    $blueprint->bigInteger("user_id")->unsigned();
    $blueprint->string("target_link");
    $blueprint->timestamps();
    $blueprint->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
});

Capsule::schema()->create('links', function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->string("target_link", 1000);
    $blueprint->bigInteger('slug_id')->unsigned();
    $blueprint->integer("order");
    $blueprint->timestamps();
    $blueprint->foreign("slug_id")->references("id")->on("slugs")->onDelete("cascade");
});


Capsule::schema()->create('clicks', function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->string("clicker_ip")->index();
    $blueprint->bigInteger('slug_id')->unsigned()->nullable();
    $blueprint->bigInteger("link_id")->unsigned()->nullable();
    $blueprint->bigInteger("user_id")->unsigned()->nullable();
    $blueprint->string("refer", 1000);
    $blueprint->timestamps();

    $blueprint->foreign("user_id")->references("id")->on("users")->nullOnDelete();
    $blueprint->foreign("slug_id")->references("id")->on("slugs")->nullOnDelete();
    $blueprint->foreign("link_id")->references("id")->on("links")->nullOnDelete();

});


Capsule::schema()->create('news', function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->string("slug")->unique();
    $blueprint->bigInteger("user_id")->unsigned();
    $blueprint->string("title");
    $blueprint->text("content");
    $blueprint->timestamps();
    $blueprint->foreign("user_id")->references("id")->on("users")->onDelete("cascade");

});

Capsule::schema()->create('roles', function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->string("role_name");
    $blueprint->timestamps();
});

Capsule::schema()->create("role_user", function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->bigInteger("user_id")->unsigned();
    $blueprint->bigInteger("role_id")->unsigned();
    $blueprint->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
    $blueprint->foreign("role_id")->references("id")->on("roles")->onDelete("cascade");
});

Capsule::schema()->create("permissions", function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->string("permission_name");
    $blueprint->string("persian_name");
    $blueprint->timestamps();
});

Capsule::schema()->create("permission_role", function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->bigInteger("permission_id")->unsigned();
    $blueprint->bigInteger("role_id")->unsigned();
    $blueprint->foreign("permission_id")->references("id")->on("permissions")->onDelete("cascade");
    $blueprint->foreign("role_id")->references("id")->on("roles")->onDelete("cascade");
});


Capsule::schema()->create("user_session_activities", function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->bigInteger("user_id")->unsigned();
    $blueprint->text("token");
    $blueprint->timestamps();

    $blueprint->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
});



// TODO: ?????????? ?????????????? ?????? ???????? ???????? ?????? ???????? ????