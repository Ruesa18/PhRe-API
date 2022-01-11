<?php

namespace PHREAPI\kernel;

use PHREAPI\kernel\utils\ConfigLoader;
use PHREAPI\kernel\utils\input\Request;
use PHREAPI\kernel\utils\output\Response;
use PHREAPI\kernel\utils\output\AbstractResponse;
use PHREAPI\kernel\utils\output\HTMLResponse;
use PHREAPI\kernel\utils\enums\HttpMethod;

/**
 * Class Kernel
 *
 * @package PHREAPI\kernel
 */
class Kernel {

    public function __construct($appDirectory) {

        $cfgLoader = new ConfigLoader();
        $cfgLoader->load($appDirectory);

        set_exception_handler(function($exception) {
            echo "<b>Exception:</b> " . $exception->getMessage();
        });

        $url = explode("/api", ROOT_URL);

        $urlEnding = false;
        if(strpos(ROOT_URL, "/api") !== false) {
            $urlEnding = count($url) > 1 && $url[1] != "" ? $url[1] : "/";
        }

        if($urlEnding) {
            $response = $this->handleRequestedUrl($urlEnding);
            $response->setHttpHeaders();
            echo $response->getBody();
            return $response->getBody();
        }
        $this->loadInfoPage();
    }

    private function handleRequestedUrl($url): AbstractResponse {
        $routes = new \PHREAPI\api\Routes();
        $endpoint = $routes->getEndpoint($url);

        if($endpoint === false) {
            return new Response(404, "Not Found");
        }

        $instance = new $endpoint();
        $response = $this->callByHttpMethod($instance);

        return $response;
    }

    private function callByHttpMethod($endpoint): AbstractResponse {
        if($endpoint !== false) {
            $request = new Request();

            switch($request->getMethod()) {
                case HttpMethod::GET:
                    return $endpoint->index($request);
                    break;
            }
        }
        return new Response(404, "Not Found");
    }

    private function loadInfoPage() {
        $routes = new \PHREAPI\api\Routes();
        $endpoints = $routes->getEndpoints();

        $table = "<h1>Routes Definition</h1>";
        $table .= "<table><tr><th>Route</th></tr>";
        foreach($endpoints as $endpointUrl => $endpointClass) {
            $table .= "<tr><td><a href='" . ROOT_URL . "api" . $endpointUrl . "'>$endpointUrl</a></td></tr>";
        }
        $table .= "</table>";
        $response = new HTMLResponse(200, $table);
        echo $response->getBody();
    }
}

?>
