<?php

namespace PHREAPI\kernel;

use PHREAPI\api\Routes;
use PHREAPI\kernel\utils\ConfigLoader;
use PHREAPI\kernel\utils\output\HTMLResponse;
use PHREAPI\kernel\utils\Router;

/**
 * Class Kernel
 *
 * @package PHREAPI\kernel
 */
class Kernel {
    public function __construct(protected Router $router = new Router()) {}

    public function init($appDirectory): ?string {
        ConfigLoader::load($appDirectory);

        set_exception_handler(static function($exception) {
            echo sprintf('<b>Exception:</b> %s', $exception->getMessage());
        });

        $url = explode('/api', ROOT_URL);

        $urlEnding = false;
        if(str_contains(ROOT_URL, '/api')) {
            $urlEnding = count($url) > 1 && $url[1] !== '' ? $url[1] : '/';
        }

        if($urlEnding) {
            $response = $this->router->handleRequestedUrl($urlEnding);
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

    private function loadInfoPage(): string {
        $routes = new Routes();
        $endpoints = $routes->getEndpoints();

        $table = '<h1>Routes Definition</h1>';

        $rows = '';
        foreach($endpoints as $endpointUrl => $endpointClass) {
            $rows .= sprintf('<tr><td><a href="%sapi%s">%s</a></td></tr>', ROOT_URL, $endpointUrl, $endpointUrl);
        }

        $table .= sprintf('<table><tr><th>Routes</th></tr>%s</table>', $rows);
        $table .= sprintf('<link rel="stylesheet" href="%ssrc/kernel/utils/output/style.css">', ROOT_URL);
        return (new HTMLResponse(200, $table))->getBody();
    }
}
