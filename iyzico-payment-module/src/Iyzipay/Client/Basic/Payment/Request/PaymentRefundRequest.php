<?php

namespace Iyzipay\Client\Basic\Payment\Request;

use Iyzipay\Client\JsonBuilder;
use Iyzipay\Client\PKIRequestStringBuilder;
use Iyzipay\Client\Request;

class PaymentRefundRequest extends Request
{
    private $paymentTransactionId;
    private $price;
    private $ip;

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

    public function getIp()
    {
        return $this->ip;
    }

    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    public function getJsonObject()
    {
        return JsonBuilder::fromJsonObject(parent::getJsonObject())
            ->add("paymentTransactionId", $this->getPaymentTransactionId())
            ->addPrice("price", $this->getPrice())
            ->add("ip", $this->getIp())
            ->getObject();
    }

    public function toPKIRequestString()
    {
        return PKIRequestStringBuilder::newInstance()
            ->appendSuper(parent::toPKIRequestString())
            ->append("paymentTransactionId", $this->getPaymentTransactionId())
            ->appendPrice("price", $this->getPrice())
            ->append("ip", $this->getIp())
            ->getRequestString();
    }
}