<?php
namespace PHREAPI\kernel\utils;

use PHREAPI\kernel\utils\output\Logger;
use Dotenv\Dotenv;

/**
 * Class ConfigLoader
 * @package PHREAPI\kernel\utils
 */
class ConfigLoader {

    public static function load(string $directory) {
        $env = Dotenv::createImmutable($directory);
        $env->load();
    }

    public static function get(string $key) {
        if(array_key_exists($key, $_ENV)) {
            return self::convert($_ENV[$key]);
        }
        return null;
    }

    public static function convert($value) {
        switch($value) {
            case "true":
                return true;
            case "false":
                return false;
            default:
                return $value;
        }
    }
}
?>
