<?php

namespace Iyzipay\Client\Ecom\Payment\Response\Mapper;

use Iyzipay\Client\Ecom\Payment\Response\EcomRetrievePaymentCheckoutFormAuthResponse;

class EcomRetrievePaymentCheckoutFormAuthResponseMapper extends EcomPaymentAuthResponseMapper
{
    public static function newInstance()
    {
        return new EcomRetrievePaymentCheckoutFormAuthResponseMapper();
    }

    public function mapResponse(EcomRetrievePaymentCheckoutFormAuthResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);

        if (isset($jsonResult->token)) {
            $response->setToken($jsonResult->token);
        }
        if (isset($jsonResult->callbackUrl)) {
            $response->setCallbackUrl($jsonResult->callbackUrl);
        }
        if (isset($jsonResult->paymentStatus)) {
            $response->setPaymentStatus($jsonResult->paymentStatus);
        }
    }
}