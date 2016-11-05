<?php

namespace Iyzipay\Client\Ecom\Payment\Response\Mapper;

use Iyzipay\Client\Ecom\Payment\Response\EcomRetrievePaymentBKMAuthResponse;

class EcomRetrievePaymentBKMAuthResponseMapper extends EcomPaymentResponseMapper
{
    public static function newInstance()
    {
        return new EcomRetrievePaymentBKMAuthResponseMapper();
    }

    public function mapResponse(EcomRetrievePaymentBKMAuthResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);
    }
}