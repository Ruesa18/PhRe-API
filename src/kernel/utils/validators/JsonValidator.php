<?php

namespace PHREAPI\kernel\utils\validators;

use JsonException;

class JsonValidator implements ValidatorInterface {

    public function validate(mixed $data): bool {
        try {
            json_decode($data, false, 512, JSON_THROW_ON_ERROR);
            return json_last_error() === JSON_ERROR_NONE;
        } catch(JsonException) {
            return false;
        }
    }
}
