<?php

namespace Iyzipay\Client\Basic\Payment\Response\Mapper;

use Iyzipay\Client\Basic\Payment\Response\PaymentRefundResponse;
use Iyzipay\Client\ResponseMapper;

class PaymentRefundResponseMapper extends ResponseMapper
{
    public static function newInstance()
    {
        return new PaymentRefundResponseMapper();
    }

    public function mapResponse(PaymentRefundResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);

        if (isset($jsonResult->paymentId)) {
            $response->setPaymentId($jsonResult->paymentId);
        }
        if (isset($jsonResult->paymentTransactionId)) {
            $response->setPaymentTransactionId($jsonResult->paymentTransactionId);
        }
        if (isset($jsonResult->price)) {
            $response->setPrice($jsonResult->price);
        }
    }
}