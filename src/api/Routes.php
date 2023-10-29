<?php
namespace PHREAPI\api;

use PHREAPI\api\endpoints\ExampleEndpoint;
use PHREAPI\kernel\utils as KernelUtils;

class Routes extends KernelUtils\Routes {
    public function __construct(?array $routes = null) {
        parent::$endpoints = $routes ?? array(
            '/example' => ExampleEndpoint::class,
            '/' => ExampleEndpoint::class
        );
    }
}
