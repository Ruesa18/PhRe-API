<?php

namespace PHREAPI\kernel\utils\security;

interface PasswordEncrypterInterface {
    public function encrypt(string $secret): string;

    public function decrypt(string $encryptedSecret): string;
}
