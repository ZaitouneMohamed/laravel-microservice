<?php

namespace App\Services;

use Illuminate\Encryption\Encrypter;

class CustomCryptoService
{
    protected $encrypter;

    public function __construct()
    {
        $key = base64_decode(config('app.app_key_2'));
        $this->encrypter = new Encrypter($key, config('app.cipher'));
    }

    public function encrypt($value)
    {
        return $this->encrypter->encrypt($value);
    }

    public function decrypt($value)
    {
        return $this->encrypter->decrypt($value);
    }
}
