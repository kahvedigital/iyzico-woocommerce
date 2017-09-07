<?php

namespace Iyzipay\Client\CardStorage\Dto;

class CardDetailDto
{
    private $cardToken;
    private $cardAlias;
    private $binNumber;
    private $cardType;
    private $cardAssociation;
    private $cardFamily;
    private $cardBankCode;
    private $cardBankName;

    public function getCardToken()
    {
        return $this->cardToken;
    }

    public function setCardToken($cardToken)
    {
        $this->cardToken = $cardToken;
    }

    public function getCardAlias()
    {
        return $this->cardAlias;
    }

    public function setCardAlias($cardAlias)
    {
        $this->cardAlias = $cardAlias;
    }

    public function getBinNumber()
    {
        return $this->binNumber;
    }

    public function setBinNumber($binNumber)
    {
        $this->binNumber = $binNumber;
    }

    public function getCardType()
    {
        return $this->cardType;
    }

    public function setCardType($cardType)
    {
        $this->cardType = $cardType;
    }

    public function getCardAssociation()
    {
        return $this->cardAssociation;
    }

    public function setCardAssociation($cardAssociation)
    {
        $this->cardAssociation = $cardAssociation;
    }

    public function getCardFamily()
    {
        return $this->cardFamily;
    }

    public function setCardFamily($cardFamily)
    {
        $this->cardFamily = $cardFamily;
    }

    public function getCardBankCode()
    {
        return $this->cardBankCode;
    }

    public function setCardBankCode($cardBankCode)
    {
        $this->cardBankCode = $cardBankCode;
    }

    public function getCardBankName()
    {
        return $this->cardBankName;
    }

    public function setCardBankName($cardBankName)
    {
        $this->cardBankName = $cardBankName;
    }
}
