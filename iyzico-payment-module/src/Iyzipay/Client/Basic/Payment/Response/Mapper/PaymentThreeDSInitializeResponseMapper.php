<?php

namespace Iyzipay\Client\Basic\Payment\Response\Mapper;

use Iyzipay\Client\Basic\Payment\Response\PaymentThreeDSInitializeResponse;
use Iyzipay\Client\ResponseMapper;

class PaymentThreeDSInitializeResponseMapper extends ResponseMapper
{
    public static function newInstance()
    {
        return new PaymentThreeDSInitializeResponseMapper();
    }

    public function mapResponse(PaymentThreeDSInitializeResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);

        if (isset($jsonResult->threeDSHtmlContent)) {
            $response->setThreeDSHtmlContent(base64_decode($jsonResult->threeDSHtmlContent));
        }
    }
}