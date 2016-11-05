<?php

namespace Iyzipay\Client\Ecom\Onboarding\Response\Mapper;

use Iyzipay\Client\Ecom\Onboarding\Response\CreateSubMerchantResponse;
use Iyzipay\Client\ResponseMapper;

class CreateSubMerchantResponseMapper extends ResponseMapper
{
    public static function newInstance()
    {
        return new CreateSubMerchantResponseMapper();
    }

    public function mapResponse(CreateSubMerchantResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);

        if (isset($jsonResult->subMerchantKey)) {
            $response->setSubMerchantKey($jsonResult->subMerchantKey);
        }
    }
}