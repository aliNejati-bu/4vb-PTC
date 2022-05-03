<?php

# load composer autoload
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

# add const
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "setConsts.php";

require_once BASE_DIR . DIRECTORY_SEPARATOR . "Boot" . DIRECTORY_SEPARATOR . "Boot.php";

// boot project
Boot::load();