<?php

namespace PHREAPI\kernel\utils\output;

/**
 * Class AbstractResponse
 * @package PHREAPI\kernel\utils\output
 */
abstract class AbstractResponse implements ResponseInterface {
    protected int $code;
    protected ?string $body;
    protected string $contentType = 'text';

    public function __construct(int $code, mixed $body = null) {
        $this->code = $code;
        $this->setBody($body);
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getBody(): ?string {
        return $this->body;
    }

    public function setBody(mixed $body): self {
        $this->body = $body;
        return $this;
    }

    public function setHttpHeaders(): self
    {
        switch($this->contentType) {
            case 'json':
                header('Content-Type: application/json');
                break;
            case 'html':
                header('Content-Type: text/html');
                break;
            default:
                header('Content-Type: text/plain');
        }

        return $this;
    }
}
