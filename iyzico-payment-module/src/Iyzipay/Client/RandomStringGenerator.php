<?php

namespace Iyzipay\Client;

class RandomStringGenerator
{
    const RANDOM_CHARS = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    static function randomString($length)
    {
        $randomString = "";
        for ($i = 0; $i < $length; $i++) {
            $randomString .= substr(self::RANDOM_CHARS, rand(0, strlen(self::RANDOM_CHARS)), 1);
        }
        return $randomString;
    }
}