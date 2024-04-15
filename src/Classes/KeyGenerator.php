<?php

namespace Itransition\Classes;

class KeyGenerator
{
    public static function generateKey(): string
    {
        return bin2hex(random_bytes(32));
    }
}