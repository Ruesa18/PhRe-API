<?php

namespace PHREAPI\kernel\utils\output;

/**
 * This class will be used to output a given response as JSON.
 *
 * @class JSONResponse
 * @package PHREAPI\kernel\utils\output
 */
class JSONResponse extends AbstractResponse {
    protected string $contentType = 'json';

    /**
     * Getter
     *
     * @return string|null returns the http-body for the response as JSON.
     */
    public function getBody(): ?string {
        return $this->body ?? null;
    }

    /**
     * @throws \JsonException
     */
    public function setBody(mixed $body): self {
        $this->body = json_encode($body, JSON_THROW_ON_ERROR);
        return $this;
    }
}
