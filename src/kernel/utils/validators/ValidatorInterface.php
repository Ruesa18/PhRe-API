<?php

namespace PHREAPI\kernel\utils\validators;

interface ValidatorInterface {
    public function validate(mixed $data): bool;
}
