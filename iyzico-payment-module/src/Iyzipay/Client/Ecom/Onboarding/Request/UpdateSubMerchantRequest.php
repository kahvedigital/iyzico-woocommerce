<?php

namespace Iyzipay\Client\Ecom\Onboarding\Request;

use Iyzipay\Client\JsonBuilder;
use Iyzipay\Client\PKIRequestStringBuilder;

class UpdateSubMerchantRequest extends SubMerchantRequest
{
    private $subMerchantKey;
    private $identityNumber;
    private $taxNumber;

    public function getSubMerchantKey()
    {
        return $this->subMerchantKey;
    }

    public function setSubMerchantKey($subMerchantKey)
    {
        $this->subMerchantKey = $subMerchantKey;
    }

    public function getIdentityNumber()
    {
        return $this->identityNumber;
    }

    public function setIdentityNumber($identityNumber)
    {
        $this->identityNumber = $identityNumber;
    }

    public function getTaxNumber()
    {
        return $this->taxNumber;
    }

    public function setTaxNumber($taxNumber)
    {
        $this->taxNumber = $taxNumber;
    }

    public function getJsonObject()
    {
        return JsonBuilder::fromJsonObject(parent::getJsonObject())
            ->add("subMerchantKey", $this->getSubMerchantKey())
            ->add("identityNumber", $this->getIdentityNumber())
            ->add("taxNumber", $this->getTaxNumber())
            ->getObject();
    }

    public function toPKIRequestString()
    {
        return PKIRequestStringBuilder::newInstance()
            ->appendSuper(parent::toPKIRequestString())
            ->append("subMerchantKey", $this->getSubMerchantKey())
            ->append("identityNumber", $this->getIdentityNumber())
            ->append("taxNumber", $this->getTaxNumber())
            ->getRequestString();
    }
}