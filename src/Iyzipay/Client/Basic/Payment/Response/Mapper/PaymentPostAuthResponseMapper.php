<?php

namespace Iyzipay\Client\Basic\Payment\Response\Mapper;

use Iyzipay\Client\Basic\Payment\Response\PaymentPostAuthResponse;
use Iyzipay\Client\ResponseMapper;

class PaymentPostAuthResponseMapper extends ResponseMapper
{
    public static function newInstance()
    {
        return new PaymentPostAuthResponseMapper();
    }

    public function mapResponse(PaymentPostAuthResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);

        if (isset($jsonResult->paymentId)) {
            $response->setPaymentId($jsonResult->paymentId);
        }
        if (isset($jsonResult->price)) {
            $response->setPrice($jsonResult->price);
        }
    }
}