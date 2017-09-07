<?php

namespace Iyzipay\Client\Ecom\Onboarding\Request;

use Iyzipay\Client\JsonBuilder;
use Iyzipay\Client\PKIRequestStringBuilder;
use Iyzipay\Client\Request;

class SubMerchantRequest extends Request
{
    private $name;
    private $email;
    private $gsmNumber;
    private $address;
    private $iban;
    private $taxOffice;
    private $contactName;
    private $contactSurname;
    private $legalCompanyTitle;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getGsmNumber()
    {
        return $this->gsmNumber;
    }

    public function setGsmNumber($gsmNumber)
    {
        $this->gsmNumber = $gsmNumber;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getIban()
    {
        return $this->iban;
    }

    public function setIban($iban)
    {
        $this->iban = $iban;
    }

    public function getTaxOffice()
    {
        return $this->taxOffice;
    }

    public function setTaxOffice($taxOffice)
    {
        $this->taxOffice = $taxOffice;
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

    public function getJsonObject()
    {
        return JsonBuilder::fromJsonObject(parent::getJsonObject())
            ->add("name", $this->getName())
            ->add("email", $this->getEmail())
            ->add("gsmNumber", $this->getGsmNumber())
            ->add("address", $this->getAddress())
            ->add("iban", $this->getIban())
            ->add("taxOffice", $this->getTaxOffice())
            ->add("contactName", $this->getContactName())
            ->add("contactSurname", $this->getContactSurname())
            ->add("legalCompanyTitle", $this->getLegalCompanyTitle())
            ->getObject();
    }

    public function toPKIRequestString()
    {
        return PKIRequestStringBuilder::newInstance()
            ->appendSuper(parent::toPKIRequestString())
            ->append("name", $this->getName())
            ->append("email", $this->getEmail())
            ->append("gsmNumber", $this->getGsmNumber())
            ->append("address", $this->getAddress())
            ->append("iban", $this->getIban())
            ->append("taxOffice", $this->getTaxOffice())
            ->append("contactName", $this->getContactName())
            ->append("contactSurname", $this->getContactSurname())
            ->append("legalCompanyTitle", $this->getLegalCompanyTitle())
            ->getRequestString();
    }
}