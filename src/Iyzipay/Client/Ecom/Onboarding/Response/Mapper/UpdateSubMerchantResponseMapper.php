<?php

namespace Iyzipay\Client\Ecom\Onboarding\Response\Mapper;

use Iyzipay\Client\Ecom\Onboarding\Response\UpdateSubMerchantResponse;
use Iyzipay\Client\ResponseMapper;

class UpdateSubMerchantResponseMapper extends ResponseMapper
{
    public static function newInstance()
    {
        return new UpdateSubMerchantResponseMapper();
    }

    public function mapResponse(UpdateSubMerchantResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);
    }
}