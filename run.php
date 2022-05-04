<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . "setConsts.php";

require_once BASE_DIR . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

require_once BASE_DIR . DIRECTORY_SEPARATOR . "Boot" . DIRECTORY_SEPARATOR . "Boot.php";
Boot::generalBoot();

if ($argc == 1) {
    echo "invalid";
} elseif ($argv[1] == "seeder") {
    echo "seeder";
    die();
} elseif ($argv[1] == "start") {
    echo "start";
    die();
} elseif ($argv[1] == "reset") {
    echo "reset";
    die();
}