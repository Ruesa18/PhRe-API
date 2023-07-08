<?php

namespace PHREAPI\kernel\utils\output;

use PHREAPI\kernel\utils\ConfigLoader;

/**
 * The Logger class will handle all debug-messages.
 */
class Logger {

    public static function log($message, $secondVar = null): void {
        self::debug($message, $secondVar);
    }

    public static function fatal($message): void {
        if(ConfigLoader::get('FATAL_MESSAGES_ACTIVE')) {
            echo $message;
        }
    }

    public static function error($message): void {
        if(ConfigLoader::get('ERROR_MESSAGES_ACTIVE')) {
            echo $message;
        }
    }

    public static function warn($message): void {
        if(ConfigLoader::get('WARN_MESSAGES_ACTIVE')) {
            echo $message;
        }
    }

    public static function info($message): void {
        if(ConfigLoader::get('INFO_MESSAGES_ACTIVE')) {
            echo $message;
        }
    }

    public static function debug($message, $secondVar = null): void {
        if(ConfigLoader::get('DEBUG_MESSAGES_ACTIVE')) {
            var_dump($message);
            if(!is_null($secondVar)) {
                var_dump($secondVar);
            }
        }
    }
}
