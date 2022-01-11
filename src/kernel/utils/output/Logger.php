<?php
namespace PHREAPI\kernel\utils\output;

use PHREAPI\kernel\utils\ConfigLoader;

/**
 * [public description]
 *
 * @var [type]
 */
class Logger {

    public static function log($message, $secondVar = null) {
        self::debug($message, $secondVar);
    }

    public static function fatal($message) {
        if(ConfigLoader::get('FATAL_MESSAGES_ACTIVE')) {
            echo $message;
        }
    }

    public static function error($message) {
        if(ConfigLoader::get('ERROR_MESSAGES_ACTIVE')) {
            echo $message;
        }
    }

    public static function warn($message) {
        if(ConfigLoader::get('WARN_MESSAGES_ACTIVE')) {
            echo $message;
        }
    }

    public static function info($message) {
        if(ConfigLoader::get('INFO_MESSAGES_ACTIVE')) {
            echo $message;
        }
    }

    public static function debug($message, $secondVar = null) {
        if(ConfigLoader::get('DEBUG_MESSAGES_ACTIVE')) {
            var_dump($message);
            if(!is_null($secondVar)) {
                var_dump($secondVar);
            }
        }
    }
}
?>
