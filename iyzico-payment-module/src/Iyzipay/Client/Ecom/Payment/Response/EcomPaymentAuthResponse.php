<?php

namespace Iyzipay\Client\Ecom\Payment\Response;

use Iyzipay\Client\Ecom\Payment\Response\Mapper\EcomPaymentAuthResponseMapper;

class EcomPaymentAuthResponse extends EcomPaymentResponse
{
    public function fromJson($jsonResult)
    {
        EcomPaymentAuthResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}