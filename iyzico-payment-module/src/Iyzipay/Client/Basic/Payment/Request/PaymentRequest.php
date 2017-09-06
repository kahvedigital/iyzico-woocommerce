<?php

namespace Iyzipay\Client\Basic\Payment\Request;

use Iyzipay\Client\JsonBuilder;
use Iyzipay\Client\PKIRequestStringBuilder;
use Iyzipay\Client\Request;

class PaymentRequest extends Request
{
    private $price;
    private $paidPrice;
    private $installment;
    private $buyerEmail;
    private $buyerId;
    private $buyerIp;
    private $paymentCard;

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPaidPrice()
    {
        return $this->paidPrice;
    }

    public function setPaidPrice($paidPrice)
    {
        $this->paidPrice = $paidPrice;
    }

    public function getInstallment()
    {
        return $this->installment;
    }

    public function setInstallment($installment)
    {
        $this->installment = $installment;
    }

    public function getBuyerEmail()
    {
        return $this->buyerEmail;
    }


    public function setBuyerEmail($buyerEmail)
    {
        $this->buyerEmail = $buyerEmail;
    }


    public function getBuyerId()
    {
        return $this->buyerId;
    }


    public function setBuyerId($buyerId)
    {
        $this->buyerId = $buyerId;
    }

    public function getBuyerIp()
    {
        return $this->buyerIp;
    }

    public function setBuyerIp($buyerIp)
    {
        $this->buyerIp = $buyerIp;
    }

    public function getPaymentCard()
    {
        return $this->paymentCard;
    }

    public function setPaymentCard($paymentCard)
    {
        $this->paymentCard = $paymentCard;
    }

    public function getJsonObject()
    {
        return JsonBuilder::fromJsonObject(parent::getJsonObject())
            ->addPrice("price", $this->getPrice())
            ->addPrice("paidPrice", $this->getPaidPrice())
            ->add("installment", $this->getInstallment())
            ->add("buyerEmail", $this->getBuyerEmail())
            ->add("buyerId", $this->getBuyerId())
            ->add("buyerIp", $this->getBuyerIp())
            ->add("paymentCard", $this->getPaymentCard())
            ->getObject();
    }

    public function toPKIRequestString()
    {
        return PKIRequestStringBuilder::newInstance()
            ->appendSuper(parent::toPKIRequestString())
            ->appendPrice("price", $this->getPrice())
            ->appendPrice("paidPrice", $this->getPaidPrice())
            ->append("installment", $this->getInstallment())
            ->append("buyerEmail", $this->getBuyerEmail())
            ->append("buyerId", $this->getBuyerId())
            ->append("buyerIp", $this->getBuyerIp())
            ->append("paymentCard", $this->getPaymentCard())
            ->getRequestString();
    }
}