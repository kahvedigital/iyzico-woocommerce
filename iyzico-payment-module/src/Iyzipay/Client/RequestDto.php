<?php

namespace Iyzipay\Client;

abstract class RequestDto implements JsonConvertible, PKIRequestStringConvertible
{
    public function toJsonString()
    {
        return JsonBuilder::jsonEncode($this->getJsonObject());
    }
}