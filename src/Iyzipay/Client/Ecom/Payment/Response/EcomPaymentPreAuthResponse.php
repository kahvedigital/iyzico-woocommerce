<?php

namespace Iyzipay\Client\Ecom\Payment\Response;

use Iyzipay\Client\Ecom\Payment\Response\Mapper\EcomPaymentPreAuthResponseMapper;

class EcomPaymentPreAuthResponse extends EcomPaymentResponse
{
    public function fromJson($jsonResult)
    {
        EcomPaymentPreAuthResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}