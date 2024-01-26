<?php
namespace PHREAPI\kernel\utils;

use PHREAPI\kernel\utils\interfaces\RoutesInterface;

abstract class AbstractRoutes implements RoutesInterface {
    public static array $endpoints = array();

    public function getEndpoints(): array {
        ksort(self::$endpoints);
        return self::$endpoints;
    }

    public function getEndpoint(string $url): ?string {
        foreach(self::$endpoints as $endpointUrl => $endpointClass) {
            if(is_string($endpointUrl) && str_contains($endpointUrl, $url)) {
                return $endpointClass;
            }
        }
        return null;
    }
}
