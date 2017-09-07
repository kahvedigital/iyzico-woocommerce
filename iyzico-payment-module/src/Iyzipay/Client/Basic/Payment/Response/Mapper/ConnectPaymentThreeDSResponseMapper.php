<?php

namespace Iyzipay\Client\Basic\Payment\Response\Mapper;

use Iyzipay\Client\Basic\Payment\Response\ConnectPaymentThreeDSResponse;

class ConnectPaymentThreeDSResponseMapper extends ConnectPaymentResponseMapper
{
    public static function newInstance()
    {
        return new ConnectPaymentThreeDSResponseMapper();
    }

    public function mapResponse(ConnectPaymentThreeDSResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);
    }
}