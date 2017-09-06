<?php

namespace Iyzipay\Client\Ecom\Onboarding\Request;

use Iyzipay\Client\JsonBuilder;
use Iyzipay\Client\PKIRequestStringBuilder;

class CreateSubMerchantRequest extends SubMerchantRequest
{
    private $subMerchantExternalId;
    private $identityNumber;
    private $taxNumber;
    private $subMerchantType;

    public function getSubMerchantExternalId()
    {
        return $this->subMerchantExternalId;
    }

    public function setSubMerchantExternalId($subMerchantExternalId)
    {
        $this->subMerchantExternalId = $subMerchantExternalId;
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

    public function getSubMerchantType()
    {
        return $this->subMerchantType;
    }

    public function setSubMerchantType($subMerchantType)
    {
        $this->subMerchantType = $subMerchantType;
    }

    public function getJsonObject()
    {
        return JsonBuilder::fromJsonObject(parent::getJsonObject())
            ->add("subMerchantExternalId", $this->getSubMerchantExternalId())
            ->add("identityNumber", $this->getIdentityNumber())
            ->add("taxNumber", $this->getTaxNumber())
            ->add("subMerchantType", $this->getSubMerchantType())
            ->getObject();
    }

    public function toPKIRequestString()
    {
        return PKIRequestStringBuilder::newInstance()
            ->appendSuper(parent::toPKIRequestString())
            ->append("subMerchantExternalId", $this->getSubMerchantExternalId())
            ->append("identityNumber", $this->getIdentityNumber())
            ->append("taxNumber", $this->getTaxNumber())
            ->append("subMerchantType", $this->getSubMerchantType())
            ->getRequestString();
    }
}