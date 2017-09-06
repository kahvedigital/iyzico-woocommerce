<?php

namespace Iyzipay\Client\CardStorage\Response\Mapper;

use Iyzipay\Client\CardStorage\Response\CreateCardResponse;
use Iyzipay\Client\ResponseMapper;

class CreateCardResponseMapper extends ResponseMapper
{
    public static function newInstance()
    {
        return new CreateCardResponseMapper();
    }

    public function mapResponse(CreateCardResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);

        if (isset($jsonResult->externalId)) {
            $response->setExternalId($jsonResult->externalId);
        }
        if (isset($jsonResult->email)) {
            $response->setEmail($jsonResult->email);
        }
        if (isset($jsonResult->cardUserKey)) {
            $response->setCardUserKey($jsonResult->cardUserKey);
        }
        if (isset($jsonResult->cardToken)) {
            $response->setCardToken($jsonResult->cardToken);
        }
    }
}