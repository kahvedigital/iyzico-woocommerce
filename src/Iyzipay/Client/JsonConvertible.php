<?php

namespace Iyzipay\Client;

interface JsonConvertible
{
    public function getJsonObject();

    public function toJsonString();
}