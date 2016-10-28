<?php

namespace Iyzipay\Client\Ecom\Payment\Response\Mapper;

use Iyzipay\Client\Ecom\Payment\Response\EcomPaymentThreeDSInitializeResponse;
use Iyzipay\Client\ResponseMapper;

class EcomPaymentThreeDSInitializeResponseMapper extends ResponseMapper
{
    public static function newInstance()
    {
        return new EcomPaymentThreeDSInitializeResponseMapper();
    }

    public function mapResponse(EcomPaymentThreeDSInitializeResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);

        if (isset($jsonResult->threeDSHtmlContent)) {
            $response->setThreeDSHtmlContent(base64_decode($jsonResult->threeDSHtmlContent));
        }
    }
}