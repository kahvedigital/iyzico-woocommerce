<?php

namespace Iyzipay\Client\Ecom\Payment\Response;

use Iyzipay\Client\Ecom\Payment\Response\Mapper\EcomPaymentCheckoutFormInitializeResponseMapper;
use Iyzipay\Client\Response;

class EcomPaymentCheckoutFormInitializeResponse extends Response
{
    private $token;
    private $checkoutFormContent;
    private $tokenExpireTime;

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function getCheckoutFormContent()
    {
        return $this->checkoutFormContent;
    }

    public function setCheckoutFormContent($checkoutFormContent)
    {
        $this->checkoutFormContent = $checkoutFormContent;
    }

    public function getTokenExpireTime()
    {
        return $this->tokenExpireTime;
    }

    public function setTokenExpireTime($tokenExpireTime)
    {
        $this->tokenExpireTime = $tokenExpireTime;
    }

    public function fromJson($jsonResult)
    {
        EcomPaymentCheckoutFormInitializeResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}