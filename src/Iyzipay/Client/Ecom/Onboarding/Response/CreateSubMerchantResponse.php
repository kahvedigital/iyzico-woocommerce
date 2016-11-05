<?php

namespace Iyzipay\Client\Ecom\Onboarding\Response;

use Iyzipay\Client\Ecom\Onboarding\Response\Mapper\CreateSubMerchantResponseMapper;
use Iyzipay\Client\Response;

class CreateSubMerchantResponse extends Response
{
    private $subMerchantKey;

    public function getSubMerchantKey()
    {
        return $this->subMerchantKey;
    }

    public function setSubMerchantKey($subMerchantKey)
    {
        $this->subMerchantKey = $subMerchantKey;
    }

    public function fromJson($jsonResult)
    {
        CreateSubMerchantResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}