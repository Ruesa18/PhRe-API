<?php

namespace PHREAPI\kernel\utils\exceptions;

/**
 * Class MissingParameterException
 *
 * @codeCoverageIgnore
 */
class MissingParameterException extends \Exception {
    public function __construct() {
        parent::__construct('An expected parameter has not been supplied. Please refer to the documentation.');
    }
}
