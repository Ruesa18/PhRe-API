<?php

namespace PHREAPI\kernel\utils\interfaces;

interface RoutesInterface {
    public function getEndpoints(): array;

    public function getEndpoint(string $url): ?string;
}
