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
    public function testLoadNegative(): void {
        $this->expectException(InvalidPathException::class);
        ConfigLoader::load(__DIR__);
    }

    public function testLoadAndGetPositive(): void {
        ConfigLoader::load(__DIR__ . '/../../resources');
        $this->assertEquals('dev', ConfigLoader::get('APP_ENV'));
    }

    public function testLoadAndGetNegative(): void {
        $appEnv = ConfigLoader::get('NOT_EXISTING_KEY');
        $this->assertNull($appEnv);
    }

    public function testConvertPositive(): void {
        $input = ['1', 'true', 'false'];
        $expectedValues = ['1', true, false];
        $inputCount = count($input);
        for($i = 0; $i < $inputCount; $i++) {
            $this->assertSame($expectedValues[$i], ConfigLoader::convert($input[$i]));
        }
    }
}
