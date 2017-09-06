<?php

namespace Iyzipay\Client\Basic\Payment\Response;

use Iyzipay\Client\Basic\Payment\Response\Mapper\PaymentRefundResponseMapper;
use Iyzipay\Client\Response;

class PaymentRefundResponse extends Response
{
    private $paymentId;
    private $paymentTransactionId;
    private $price;

    public function getPaymentId()
    {
        return $this->paymentId;
    }

    public function setPaymentId($paymentId)
    {
        $this->paymentId = $paymentId;
    }

    public function getPaymentTransactionId()
    {
        return $this->paymentTransactionId;
    }

    public function setPaymentTransactionId($paymentTransactionId)
    {
        $this->paymentTransactionId = $paymentTransactionId;
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
        PaymentRefundResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}