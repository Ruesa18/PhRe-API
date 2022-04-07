<?php

    namespace PHREAPI\kernel\utils\security;

    interface PasswordHasher {

        public function encrypt(string $secret): string;

        public function verify(string $secret, $encryptedSecret): bool;
    }
?>
