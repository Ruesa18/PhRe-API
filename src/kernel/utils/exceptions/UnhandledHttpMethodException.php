<?php

namespace PHREAPI\kernel\utils\exceptions;

/**
 * Class UnhandledHttpMethodException
 *
 * @codeCoverageIgnore
 */
class UnhandledHttpMethodException extends \Exception {
    public function __construct() {
        parent::__construct('The used HTTP-Method has sadly not been handled yet.');
    }
}
