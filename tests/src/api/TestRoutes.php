<?php

namespace PHREAPITests\src\api;

use PHREAPI\kernel\utils\Routes;
use PHREAPITests\src\api\endpoints\TestEndpoint;

class TestRoutes extends Routes {
    public function __construct(?array $routes = null) {
        parent::$endpoints = $routes ?? array(
            '/test' => TestEndpoint::class,
        );
    }
}
