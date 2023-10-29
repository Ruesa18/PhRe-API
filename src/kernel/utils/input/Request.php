<?php
namespace PHREAPI\kernel\utils\input;

use PHREAPI\kernel\utils\enums\HttpMethod;
use PHREAPI\kernel\utils\exceptions\UnhandledHttpMethodException;
use PHREAPI\kernel\utils\validators\JsonValidator;

class Request {
    private mixed $data = null;
    private string $method;
    private array $parameters;
    private string $url;

    /**
     * @throws UnhandledHttpMethodException|\JsonException
     */
    public function __construct() {
        switch($_SERVER['REQUEST_METHOD']) {
            case HttpMethod::GET:
                $this->data = $_GET;
                $this->method = HttpMethod::GET;
                break;
            case HttpMethod::POST:
                $requestBody = file_get_contents('php://input');
                $validator = new JsonValidator();
                if($validator->validate($requestBody)) {
                   $this->data = json_decode($requestBody, false, 512, JSON_THROW_ON_ERROR);
                }
                $this->method = HttpMethod::POST;
                break;
            case HttpMethod::DELETE:
                $this->method = HttpMethod::DELETE;
                break;
            default:
                throw new UnhandledHttpMethodException();
        }
    }

    public function setUrl(string $url): self {
        $this->url = $url;
        return $this;
    }

    public function setParameters(array $parameters): self {
        $this->parameters = $this->cleanParameters($parameters);
        return $this;
    }

    /**
     * This getter will return the request-data.
     *
     * @return array holds the data that was sent via the chosen http-request-method.
     */
    public function getData(): mixed {
        return $this->data;
    }

    public function getMethod(): string {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getUrl(): string {
        return $this->url;
    }

    public function getParameters(): array {
        return $this->parameters;
    }

    private function cleanParameters(array $parameters): array {
        foreach($parameters as $key => $parameter) {
            $parameters[$key] = str_replace('/', '', $parameter);
        }
        return $parameters;
    }
}
