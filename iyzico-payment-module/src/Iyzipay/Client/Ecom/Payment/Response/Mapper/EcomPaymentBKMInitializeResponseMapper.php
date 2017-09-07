<?php

namespace Iyzipay\Client\Ecom\Payment\Response\Mapper;

use Iyzipay\Client\Ecom\Payment\Response\EcomPaymentBKMInitializeResponse;

class EcomPaymentBKMInitializeResponseMapper extends EcomPaymentResponseMapper
{
    public static function newInstance()
    {
        return new EcomPaymentBKMInitializeResponseMapper();
    }

    public function mapResponse(EcomPaymentBKMInitializeResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);

        if (isset($jsonResult->htmlContent)) {
            $response->setHtmlContent($jsonResult->htmlContent);
        }
    }
}