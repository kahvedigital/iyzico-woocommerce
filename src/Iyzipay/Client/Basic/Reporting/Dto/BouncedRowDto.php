<?php

namespace Iyzipay\Client\Basic\Reporting\Dto;

class BouncedRowDto
{
    private $subMerchantKey;
    private $iban;
    private $contactName;
    private $contactSurname;
    private $legalCompanyTitle;
    private $marketplaceSubmerchantType;

    public function getSubMerchantKey()
    {
        return $this->subMerchantKey;
    }

    public function setSubMerchantKey($subMerchantKey)
    {
        $this->subMerchantKey = $subMerchantKey;
    }

    public function getIban()
    {
        return $this->iban;
    }

    public function setIban($iban)
    {
        $this->iban = $iban;
    }

    public function getContactName()
    {
        return $this->contactName;
    }

    public function setContactName($contactName)
    {
        $this->contactName = $contactName;
    }

    public function getContactSurname()
    {
        return $this->contactSurname;
    }

    public function setContactSurname($contactSurname)
    {
        $this->contactSurname = $contactSurname;
    }

    public function getLegalCompanyTitle()
    {
        return $this->legalCompanyTitle;
    }

    public function setLegalCompanyTitle($legalCompanyTitle)
    {
        $this->legalCompanyTitle = $legalCompanyTitle;
    }

    public function getMarketplaceSubmerchantType()
    {
        return $this->marketplaceSubmerchantType;
    }

    public function setMarketplaceSubmerchantType($marketplaceSubmerchantType)
    {
        $this->marketplaceSubmerchantType = $marketplaceSubmerchantType;
    }
}