<?php

namespace PHREAPI\kernel\utils\exceptions;

/**
 * Class SadnessOverflowException
 *
 * @codeCoverageIgnore
 */
class SadnessOverflowException extends \Exception {
    public function __construct() {
        parent::__construct('Max Sadness-Level reached. System shutting down.');
    }
}
