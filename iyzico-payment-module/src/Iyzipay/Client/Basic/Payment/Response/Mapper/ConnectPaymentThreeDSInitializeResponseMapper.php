<?php

namespace Iyzipay\Client\Basic\Payment\Response\Mapper;

use Iyzipay\Client\Basic\Payment\Response\ConnectPaymentThreeDSInitializeResponse;

class ConnectPaymentThreeDSInitializeResponseMapper extends PaymentThreeDSInitializeResponseMapper
{
    public static function newInstance()
    {
        return new ConnectPaymentThreeDSInitializeResponseMapper();
    }

    public function mapResponse(ConnectPaymentThreeDSInitializeResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);
    }
}