<?php

namespace PHREAPI\kernel\utils\interfaces\database;

interface DatabaseConnectable {
    function execute(string $statement, ?array $data = null): self;
}
