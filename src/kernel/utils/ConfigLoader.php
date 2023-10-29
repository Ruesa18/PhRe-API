<?php
namespace PHREAPI\kernel\utils;

use Dotenv\Dotenv;

/**
 * Class ConfigLoader
 * @package PHREAPI\kernel\utils
 */
class ConfigLoader {
    public static function load(string $directory): void {
        $env = Dotenv::createImmutable($directory);
        $env->load();
    }

    public static function get(string $key): bool|string|null {
        if(array_key_exists($key, $_ENV)) {
            return self::convert($_ENV[$key]);
        }
        return null;
    }

    public static function convert(string $value): string|bool {
        return match ($value) {
            'true' => true,
            'false' => false,
            default => $value,
        };
    }
}
