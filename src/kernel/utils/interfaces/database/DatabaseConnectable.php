<?php

namespace PHREAPI\kernel\utils\interfaces\database;

interface DatabaseConnectable {
    function __construct(string $host, string $user, string $password, string $database, int $port = 3306);

    function execute(string $statement, $data = null);
}
?>
