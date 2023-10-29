<?php

namespace PHREAPI\kernel\utils;

use PHREAPI\api\Routes;
use PHREAPI\kernel\utils\endpoints\EndpointInterface;
use PHREAPI\kernel\utils\enums\HttpMethod;
use PHREAPI\kernel\utils\input\Request;
use PHREAPI\kernel\utils\output\JSONResponse;
use PHREAPI\kernel\utils\output\ResponseInterface;

class Router {
    public function __construct(protected Routes $routes = new Routes()) {}

    public function handleRequestedUrl($url): ResponseInterface {
        $pos = strpos($url, '/', 1);
        if($pos !== false) {
            $urlParts = str_split($url, strpos($url, '/', 1));
        } else {
            $urlParts = [$url];
        }

        $endpoint = $this->routes->getEndpoint($urlParts[0]);

        if(!$endpoint) {
            return new JSONResponse(404);
        }

        $instance = new $endpoint();
        $request = new Request();
        $url = '' . $urlParts[0];
        array_shift($urlParts);

        return $this->callByHttpMethod($instance, $request->setUrl($url)->setParameters($urlParts));
    }

    public function callByHttpMethod(?EndpointInterface $endpoint, Request $request): ResponseInterface {
        if($endpoint !== null) {
            switch($request->getMethod()) {
                case HttpMethod::GET:
                    return $endpoint->index($request);
                case HttpMethod::POST:
                    return $endpoint->create($request);
                case HttpMethod::DELETE:
                    return $endpoint->delete($request);
            }
        }
        return new JSONResponse(404, 'Not Found');
    }
}
