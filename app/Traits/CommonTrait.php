<?php

namespace App\Traits;

trait CommonTrait
{
    public function decrypt_string($string)
    {
        $wp_encryption = config('app.laravel_wp_encryption');
        $decryption = openssl_decrypt ($string, $wp_encryption['ciphering'], $wp_encryption['key'], 0, $wp_encryption['iv']);
        return $decryption;
    }
}



?>