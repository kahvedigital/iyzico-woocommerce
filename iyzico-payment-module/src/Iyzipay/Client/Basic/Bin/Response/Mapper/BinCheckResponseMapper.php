<?php

namespace Iyzipay\Client\Basic\Bin\Response\Mapper;

use Iyzipay\Client\Basic\Bin\Response\BinCheckResponse;
use Iyzipay\Client\ResponseMapper;

class BinCheckResponseMapper extends ResponseMapper
{
    public static function newInstance()
    {
        return new BinCheckResponseMapper();
    }

    public function mapResponse(BinCheckResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);

        if (isset($jsonResult->binNumber)) {
            $response->setBinNumber($jsonResult->binNumber);
        }
        if (isset($jsonResult->cardType)) {
            $response->setCardType($jsonResult->cardType);
        }
        if (isset($jsonResult->cardAssociation)) {
            $response->setCardAssociation($jsonResult->cardAssociation);
        }
        if (isset($jsonResult->cardFamily)) {
            $response->setCardFamily($jsonResult->cardFamily);
        }
        if (isset($jsonResult->bankName)) {
            $response->setBankName($jsonResult->bankName);
        }
        if (isset($jsonResult->bankCode)) {
            $response->setBankCode($jsonResult->bankCode);
        }
    }
}