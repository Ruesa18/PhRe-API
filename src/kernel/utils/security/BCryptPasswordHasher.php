<?php

namespace PHREAPI\kernel\utils\security;

class BCryptPasswordHasher implements PasswordHasherInterface {

    public function encrypt(string $secret): string {
        return password_hash($secret, PASSWORD_BCRYPT);
    }

    public function verify(string $secret, $encryptedSecret): bool {
        return password_verify($secret, $encryptedSecret);
    }
}
