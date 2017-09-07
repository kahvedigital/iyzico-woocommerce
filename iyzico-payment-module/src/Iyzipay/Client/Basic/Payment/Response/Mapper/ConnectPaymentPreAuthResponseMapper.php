<?php

namespace Iyzipay\Client\Basic\Payment\Response\Mapper;

use Iyzipay\Client\Basic\Payment\Response\ConnectPaymentPreAuthResponse;

class ConnectPaymentPreAuthResponseMapper extends ConnectPaymentResponseMapper
{
    public static function newInstance()
    {
        return new ConnectPaymentPreAuthResponseMapper();
    }

    public function mapResponse(ConnectPaymentPreAuthResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);
    }
}