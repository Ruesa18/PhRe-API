<?php
namespace PHREAPITests\kernel\utils;

use PHPUnit\Framework\TestCase;
use PHREAPI\kernel\utils\ConfigLoader;

/**
 * Class ConfigLoaderTest
 *
 * @package PHREAPITests\kernel\utils
 */
class ConfigLoaderTest extends TestCase {

    function testLoad() {
        ConfigLoader::load(__DIR__ . "/../../resources");
        $this->assertEquals("dev", ConfigLoader::get("APP_ENV"));
    }
}


?>
