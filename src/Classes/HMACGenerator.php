<?php

namespace Itransition\Classes;

class HMACGenerator
{
    public static function generateHMAC(string $message, string $key): string
    {
        return hash_hmac('sha256', $message, $key);
    }
}