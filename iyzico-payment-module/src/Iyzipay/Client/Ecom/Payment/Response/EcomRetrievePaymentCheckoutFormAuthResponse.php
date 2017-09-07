<?php

namespace Iyzipay\Client\Ecom\Payment\Response;

use Iyzipay\Client\Ecom\Payment\Response\Mapper\EcomRetrievePaymentCheckoutFormAuthResponseMapper;

class EcomRetrievePaymentCheckoutFormAuthResponse extends EcomPaymentAuthResponse
{
    private $token;
    private $callbackUrl;
    private $paymentStatus;

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function getCallbackUrl()
    {
        return $this->callbackUrl;
    }

    public function setCallbackUrl($callbackUrl)
    {
        $this->callbackUrl = $callbackUrl;
    }

    public function getPaymentStatus()
    {
        return $this->paymentStatus;
    }

    public function setPaymentStatus($paymentStatus)
    {
        $this->paymentStatus = $paymentStatus;
    }

    public function fromJson($jsonResult)
    {
        EcomRetrievePaymentCheckoutFormAuthResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}