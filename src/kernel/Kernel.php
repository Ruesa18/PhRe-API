<?php

namespace PHREAPI\kernel;

use PHREAPI\api\endpoints\EndpointInterface;
use PHREAPI\api\Routes;
use PHREAPI\kernel\utils\ConfigLoader;
use PHREAPI\kernel\utils\enums\HttpMethod;
use PHREAPI\kernel\utils\input\Request;
use PHREAPI\kernel\utils\output\HTMLResponse;
use PHREAPI\kernel\utils\output\JSONResponse;
use PHREAPI\kernel\utils\output\ResponseInterface;

/**
 * Class Kernel
 *
 * @package PHREAPI\kernel
 */
class Kernel {

    public function init($appDirectory): ?string {
        ConfigLoader::load($appDirectory);

        set_exception_handler(function($exception) {
            echo "<b>Exception:</b> " . $exception->getMessage();
        });

        $url = explode("/api", ROOT_URL);

        $urlEnding = false;
        if(str_contains(ROOT_URL, "/api")) {
            $urlEnding = count($url) > 1 && $url[1] !== "" ? $url[1] : "/";
        }

        if($urlEnding) {
            $response = $this->handleRequestedUrl($urlEnding);
            $page = $response->setHttpHeaders()->getBody();
            http_response_code($response->getCode());

            if($page !== null) {
                echo $page;
            }
            return $page;
        }
        $page = $this->loadInfoPage();

        echo $page;
        return $page;
    }

    private function handleRequestedUrl($url): ResponseInterface {
        $routes = new Routes();
        $pos = strpos($url, '/', 1);
        if($pos !== false) {
            $urlParts = str_split($url, strpos($url, '/', 1));
        } else {
            $urlParts = [$url];
        }

        $endpoint = $routes->getEndpoint($urlParts[0]);

        if(!$endpoint) {
            return new JSONResponse(404);
        }

        $instance = new $endpoint();
        $request = new Request();
        $url = '' . $urlParts[0];
        array_shift($urlParts);

        return $this->callByHttpMethod($instance, $request->setUrl($url)->setParameters($urlParts));
    }

    private function callByHttpMethod(?EndpointInterface $endpoint, Request $request): ResponseInterface {
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
        return new JSONResponse(404, "Not Found");
    }

    private function loadInfoPage(): string {
        $routes = new Routes();
        $endpoints = $routes->getEndpoints();

        $table = "<h1>Routes Definition</h1>";
        $table .= "<table><tr><th>Routes</th></tr>";
        foreach($endpoints as $endpointUrl => $endpointClass) {
            $table .= "<tr><td><a href='" . ROOT_URL . "api" . $endpointUrl . "'>$endpointUrl</a></td></tr>";
        }
        $table .= "</table>";
        $table .= "<link rel='stylesheet' href='" . ROOT_URL . "src/kernel/utils/output/style.css'>";
        return (new HTMLResponse(200, $table))->getBody();
    }
}
