<?php

namespace Iyzipay\Client\Ecom\Payment\Response;

use Iyzipay\Client\Ecom\Payment\Response\Mapper\EcomPaymentThreeDSResponseMapper;

class EcomPaymentThreeDSResponse extends EcomPaymentResponse
{
    public function fromJson($jsonResult)
    {
        EcomPaymentThreeDSResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}