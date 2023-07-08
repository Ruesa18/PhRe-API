<?php
namespace PHREAPI\api;

use PHREAPI\api\endpoints\ExampleEndpoint;
use PHREAPI\kernel\utils as KernelUtils;

class Routes extends KernelUtils\Routes {
    public function __construct() {
        parent::$endpoints = array(
            "/example" => ExampleEndpoint::class,
            "/" => ExampleEndpoint::class
        );
    }
}
