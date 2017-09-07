<?php

namespace Iyzipay\Client\Basic\Installment\Request;

use Iyzipay\Client\JsonBuilder;
use Iyzipay\Client\PKIRequestStringBuilder;
use Iyzipay\Client\Request;

class InstallmentInfoRequest extends Request
{
    private $binNumber;
    private $price;

    public function getBinNumber()
    {
        return $this->binNumber;
    }

    public function setBinNumber($binNumber)
    {
        $this->binNumber = $binNumber;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getJsonObject()
    {
        return JsonBuilder::fromJsonObject(parent::getJsonObject())
            ->add("binNumber", $this->getBinNumber())
            ->addPrice("price", $this->getPrice())
            ->getObject();
    }

    public function toPKIRequestString()
    {
        return PKIRequestStringBuilder::newInstance()
            ->appendSuper(parent::toPKIRequestString())
            ->append("binNumber", $this->getBinNumber())
            ->appendPrice("price", $this->getPrice())
            ->getRequestString();
    }
}