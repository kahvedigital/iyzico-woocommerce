<?php

namespace Iyzipay\Client\Basic\Bin\Response;

use Iyzipay\Client\Basic\Bin\Response\Mapper\BinCheckResponseMapper;
use Iyzipay\Client\Response;

class BinCheckResponse extends Response
{
    private $binNumber;
    private $cardType;
    private $cardAssociation;
    private $cardFamily;
    private $bankName;
    private $bankCode;

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

    public function getBankName()
    {
        return $this->bankName;
    }

    public function setBankName($bankName)
    {
        $this->bankName = $bankName;
    }

    public function getBankCode()
    {
        return $this->bankCode;
    }

    public function setBankCode($bankCode)
    {
        $this->bankCode = $bankCode;
    }

    public function fromJson($jsonResult)
    {
        BinCheckResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}