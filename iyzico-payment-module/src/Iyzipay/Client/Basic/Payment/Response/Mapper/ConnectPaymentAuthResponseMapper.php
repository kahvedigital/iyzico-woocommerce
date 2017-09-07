<?php

namespace Iyzipay\Client\Basic\Payment\Response\Mapper;

use Iyzipay\Client\Basic\Payment\Response\ConnectPaymentAuthResponse;

class ConnectPaymentAuthResponseMapper extends ConnectPaymentResponseMapper
{

    public static function newInstance()
    {
        return new ConnectPaymentAuthResponseMapper();
    }

    public function mapResponse(ConnectPaymentAuthResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);
    }
}