<?php

namespace PHREAPI;

use PHREAPI\kernel\utils\input\Request;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$defaultAppDir = dirname(dirname(__FILE__));

try{
    $kernel = new kernel\Kernel(ROOT_DIR ?? $defaultAppDir);
}catch(\PHREAPI\kernel\utils\exceptions\SadnessOverflowException $e) {
    echo $e->getMessage();
}

// $endpoint = new \PHREAPI\api\endpoints\ExampleEndpoint();
// $response = $endpoint->index(new Request());
// $response->setHttpHeaders();
// echo $response->getBody();
