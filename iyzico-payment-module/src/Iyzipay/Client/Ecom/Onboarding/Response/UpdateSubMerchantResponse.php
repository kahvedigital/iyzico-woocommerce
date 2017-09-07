<?php

namespace Iyzipay\Client\Ecom\Onboarding\Response;

use Iyzipay\Client\Ecom\Onboarding\Response\Mapper\UpdateSubMerchantResponseMapper;
use Iyzipay\Client\Response;

class UpdateSubMerchantResponse extends Response
{
    public function fromJson($jsonResult)
    {
        UpdateSubMerchantResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}