<?php

namespace PHREAPI\kernel\utils\interfaces\database;

interface DatabaseConnectable {
    public function execute(string $statement, ?array $data = null): self;
}
