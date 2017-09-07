<?php

namespace Iyzipay\Client\Ecom\Payment\Response\Mapper;

use Iyzipay\Client\Ecom\Payment\Response\EcomPaymentPreAuthResponse;

class EcomPaymentPreAuthResponseMapper extends EcomPaymentResponseMapper
{
    public static function newInstance()
    {
        return new EcomPaymentPreAuthResponseMapper();
    }

    public function mapResponse(EcomPaymentPreAuthResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);
    }
}