<?php

namespace PTC\Classes\Validator;

use Closure;
use Illuminate\Database\Eloquent\Model;
use PTC\Classes\Config;

class Rules
{
    /**
     * @param $model
     * @param string $field
     * @return Closure
     */
    public static function unique($model, string $field): Closure
    {
        /**
         * @param $value
         * @return bool|string
         * @throws \Exception
         */
        return function ($value) use ($model, $field): bool|string {
            $result = $model::where($field, $value)->first();
            if (!is_null($result)) {
                return self::getMassage('rule.unique');
            }
            return true;
        };
    }


    /**
     * @throws \Exception
     */
    private static function getMassage($ruleName): string
    {
        $appLang = Config::getInstance()->getAllConfig("app")["lang"] ?? "fa";

        $langPath = BASE_DIR . DIRECTORY_SEPARATOR . "Classes" . DIRECTORY_SEPARATOR . "Validator" . DIRECTORY_SEPARATOR . "Lang" . DIRECTORY_SEPARATOR . $appLang;
        if (!file_exists($langPath)) {
            throw new \Exception($langPath . " is not lang!.");
        }

        if (!file_exists($langPath . DIRECTORY_SEPARATOR . "lang.php") || !file_exists($langPath . DIRECTORY_SEPARATOR . "attributeAliases.php")) {
            throw new \Exception($langPath . " is not lang!.");
        }

        $langArray = require $langPath . DIRECTORY_SEPARATOR . "lang.php";
        return $langArray[$ruleName];
    }
}