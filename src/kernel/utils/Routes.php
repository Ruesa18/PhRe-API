<?php
namespace PHREAPI\kernel\utils;

abstract class Routes {
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
