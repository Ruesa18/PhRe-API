<?php
namespace PHREAPI\kernel\utils\input;

use PHREAPI\kernel\utils\exceptions;
use PHREAPI\kernel\utils\enums\HttpMethod;

class Request {
    private array $data;
    private string $method;

    function __construct() {
        switch($_SERVER['REQUEST_METHOD']) {
            case HttpMethod::GET:
                $this->data = $_GET;
                $this->method = HttpMethod::GET;
                break;
            case HttpMethod::POST:
                $this->data = $_POST;
                $this->method = HttpMethod::POST;
                break;
            default:
                throw new UnhandledHttpMethodException();
                break;
        }
    }

    /**
     * This getter will return the request-data.
     *
     * @return array holds the data that was sent via the chosen http-request-method.
     */
    public function getData() {
        return $this->data;
    }

    public function getMethod() {
        return $this->method;
    }
}
?>
