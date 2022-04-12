<?php
namespace PHREAPITests\kernel\utils;

use PHPUnit\Framework\TestCase;
use PHREAPI\kernel\utils\ConfigLoader;
use Dotenv\Exception\InvalidPathException;

/**
 * Class ConfigLoaderTest
 *
 * @package PHREAPITests\kernel\utils
 */
class ConfigLoaderTest extends TestCase {

    function testLoadNegative() {
        $this->expectException(InvalidPathException::class);
        ConfigLoader::load(__DIR__);
    }

    function testLoadAndGetPositive() {
        ConfigLoader::load(__DIR__ . "/../../resources");
        $this->assertEquals("dev", ConfigLoader::get("APP_ENV"));
    }

    function testLoadAndGetNegative() {
        $appEnv = ConfigLoader::get("NOT_EXISTING_KEY");
        $this->assertNull($appEnv);
    }

    function testConvertPositive() {
        $input = ["1", "true", "false"];
        $expectedValues = ["1", true, false];
        for($i = 0; $i < count($input); $i++) {
            $this->assertSame($expectedValues[$i], ConfigLoader::convert($input[$i]));
        }
    }
}


?>
