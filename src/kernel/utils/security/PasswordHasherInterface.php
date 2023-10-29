<?php

namespace PHREAPI\kernel\utils\security;

interface PasswordHasherInterface {
    public function encrypt(string $secret): string;

    public function verify(string $secret, $encryptedSecret): bool;
}

