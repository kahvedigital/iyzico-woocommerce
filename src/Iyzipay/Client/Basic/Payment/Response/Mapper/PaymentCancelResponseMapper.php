<?php

namespace Iyzipay\Client\Basic\Payment\Response\Mapper;

use Iyzipay\Client\Basic\Payment\Response\PaymentCancelResponse;
use Iyzipay\Client\ResponseMapper;

class PaymentCancelResponseMapper extends ResponseMapper
{
    public static function newInstance()
    {
        return new PaymentCancelResponseMapper();
    }

    public function mapResponse(PaymentCancelResponse $response, $jsonResult)
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