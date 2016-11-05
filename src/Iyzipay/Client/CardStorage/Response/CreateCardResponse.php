<?php

namespace Iyzipay\Client\CardStorage\Response;

use Iyzipay\Client\CardStorage\Response\Mapper\CreateCardResponseMapper;
use Iyzipay\Client\Response;

class CreateCardResponse extends Response
{
    private $externalId;
    private $email;
    private $cardUserKey;
    private $cardToken;

    public function getExternalId()
    {
        return $this->externalId;
    }

    public function setExternalId($externalId)
    {
        $this->externalId = $externalId;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getCardUserKey()
    {
        return $this->cardUserKey;
    }

    public function setCardUserKey($cardUserKey)
    {
        $this->cardUserKey = $cardUserKey;
    }

    public function getCardToken()
    {
        return $this->cardToken;
    }

    public function setCardToken($cardToken)
    {
        $this->cardToken = $cardToken;
    }

    public function fromJson($jsonResult)
    {
        CreateCardResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}