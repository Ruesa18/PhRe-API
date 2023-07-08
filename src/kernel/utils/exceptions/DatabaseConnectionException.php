<?php

namespace PHREAPI\kernel\utils\exceptions;

/**
 * Class DatabaseConnectionException
 *
 * @codeCoverageIgnore
 */
class DatabaseConnectionException extends \Exception {

    public function __construct() {
        parent::__construct("The database connection could not be established. Check your configuration, consult the README and/or the code documentation.");
    }
}
