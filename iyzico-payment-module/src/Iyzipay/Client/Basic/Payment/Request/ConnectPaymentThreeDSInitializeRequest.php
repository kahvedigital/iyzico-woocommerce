<?php

namespace Iyzipay\Client\Basic\Payment\Request;

use Iyzipay\Client\JsonBuilder;
use Iyzipay\Client\PKIRequestStringBuilder;

class ConnectPaymentThreeDSInitializeRequest extends ConnectPaymentRequest
{
    private $callbackUrl;

    public function getCallbackUrl()
    {
        return $this->callbackUrl;
    }

    public function setCallbackUrl($callbackUrl)
    {
        $this->callbackUrl = $callbackUrl;
    }

    public function getJsonObject()
    {
        return JsonBuilder::fromJsonObject(parent::getJsonObject())
            ->add("callbackUrl", $this->getCallbackUrl())
            ->getObject();
    }

    public function toPKIRequestString()
    {
        return PKIRequestStringBuilder::newInstance()
            ->appendSuper(parent::toPKIRequestString())
            ->append("callbackUrl", $this->getCallbackUrl())
            ->getRequestString();
    }
}