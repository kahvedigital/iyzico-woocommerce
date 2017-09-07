<?php

namespace Iyzipay\Client\Ecom\Payment\Response\Mapper;

use Iyzipay\Client\Ecom\Payment\Response\EcomPaymentThreeDSResponse;

class EcomPaymentThreeDSResponseMapper extends EcomPaymentResponseMapper
{
    public static function newInstance()
    {
        return new EcomPaymentThreeDSResponseMapper();
    }

    public function mapResponse(EcomPaymentThreeDSResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);
    }

}