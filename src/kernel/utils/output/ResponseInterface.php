<?php

namespace PHREAPI\kernel\utils\output;

/**
 * This class will be used to output any content as plain text.
 *
 * @class Response
 * @package PHREAPI\kernel\utils\output
 */
interface ResponseInterface {
    public function getCode(): int;

    public function getBody(): ?string;

    public function setBody(mixed $body): self;

    public function setHttpHeaders(): self;
}
