<?php

namespace PHREAPITests\src\api;

use PHREAPI\kernel\utils\AbstractRoutes;
use PHREAPITests\src\api\endpoints\TestEndpoint;

class TestAbstractRoutes extends AbstractRoutes {
    public function __construct(?array $routes = null) {
        parent::$endpoints = $routes ?? array(
            '/test' => TestEndpoint::class,
        );
    }
}
