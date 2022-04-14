<?php
namespace PHREAPI\kernel\utils;

abstract class Routes {
    public static array $endpoints = array();

    public function getEndpoints() {
        ksort(self::$endpoints);
        return self::$endpoints;
    }

    public function getEndpoint(string $url) {
        foreach(self::$endpoints as $endpointUrl => $endpointClass) {
            if(is_string($endpointUrl) && $endpointUrl == $url) {
                return $endpointClass;
            }
        }
        return false;
    }
}
?>
