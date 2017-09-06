<?php

namespace Iyzipay\Client\CardStorage\Response;

use Iyzipay\Client\CardStorage\Response\Mapper\RetrieveCardListResponseMapper;
use Iyzipay\Client\Response;

class RetrieveCardListResponse extends Response
{
    private $cardUserKey;
    private $cardDetails;

    public function getCardUserKey()
    {
        return $this->cardUserKey;
    }

    public function setCardUserKey($cardUserKey)
    {
        $this->cardUserKey = $cardUserKey;
    }

    public function getCardDetails()
    {
        return $this->cardDetails;
    }

    public function setCardDetails($cardDetails)
    {
        $this->cardDetails = $cardDetails;
    }

    public function fromJson($jsonResult)
    {
        RetrieveCardListResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}