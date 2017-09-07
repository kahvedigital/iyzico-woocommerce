<?php

namespace Iyzipay\Client\Ecom\Payment\Response\Mapper;

use Iyzipay\Client\Ecom\Payment\Response\EcomPaymentAuthResponse;

class EcomPaymentAuthResponseMapper extends EcomPaymentResponseMapper
{
    public static function newInstance()
    {
        return new EcomPaymentAuthResponseMapper();
    }

    public function mapResponse(EcomPaymentAuthResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);
    }
}