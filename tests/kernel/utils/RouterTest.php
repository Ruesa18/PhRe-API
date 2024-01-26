<?php

namespace PHREAPITests\kernel\utils;

use PHPUnit\Framework\TestCase;
use PHREAPI\kernel\utils\enums\HttpMethod;
use PHREAPI\kernel\utils\exceptions\UnhandledHttpMethodException;
use PHREAPI\kernel\utils\Router;

/**
 * Class ConfigLoaderTest
 *
 * @package PHREAPITests\kernel\utils
 */
class RouterTest extends TestCase {
    private Router $router;

    public function setUp(): void {
        $this->router = new Router();
    }

    /**
     * @throws \JsonException
     */
    public function testRoutingPositive(): void {
        $_SERVER['REQUEST_METHOD'] = HttpMethod::GET;

        $response = $this->router->handleRequestedUrl('/test');

        $this->assertEquals(200, $response->getCode());
        $this->assertEquals(json_encode(['name' => 'test'], JSON_THROW_ON_ERROR), $response->getBody());
    }

    public function testRoutingNegativeUnhandledMethod(): void {
        $_SERVER['REQUEST_METHOD'] = HttpMethod::DELETE;

        $this->expectException(UnhandledHttpMethodException::class);

        $this->router->handleRequestedUrl('/test');
    }

    public function testRoutingNegativeUnhandledRoute(): void {
        $_SERVER['REQUEST_METHOD'] = HttpMethod::GET;

        $response = $this->router->handleRequestedUrl('/i-am-not-a-route');

        $this->assertEquals(404, $response->getCode());
        $this->assertEmpty($response->getBody());
    }
}
