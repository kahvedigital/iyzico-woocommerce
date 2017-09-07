<?php

namespace Iyzipay\Client;

class Digest
{
    public static function hash($data)
    {
        return base64_encode(sha1($data, true));
    }
}