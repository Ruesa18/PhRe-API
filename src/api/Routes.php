<?php
namespace PHREAPI\api;

class Routes extends \PHREAPI\kernel\utils\Routes {
    public function __construct() {
        parent::$endpoints = array(
            "/example" => \PHREAPI\api\endpoints\ExampleEndpoint::class,
            "/" => \PHREAPI\api\endpoints\ExampleEndpoint::class
        );
    }
}
?>
