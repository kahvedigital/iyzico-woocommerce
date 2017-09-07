<?php

namespace Iyzipay\Client\Basic\Payment\Response;

use Iyzipay\Client\Basic\Payment\Response\Mapper\PaymentPostAuthResponseMapper;
use Iyzipay\Client\Response;

class PaymentPostAuthResponse extends Response
{
    private $paymentId;
    private $price;

    public function getPaymentId()
    {
        return $this->paymentId;
    }

    public function setPaymentId($paymentId)
    {
        $this->paymentId = $paymentId;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function fromJson($jsonResult)
    {
        PaymentPostAuthResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}