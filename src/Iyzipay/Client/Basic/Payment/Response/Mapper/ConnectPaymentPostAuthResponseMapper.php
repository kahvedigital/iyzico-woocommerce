<?php

namespace Iyzipay\Client\Basic\Payment\Response\Mapper;

use Iyzipay\Client\Basic\Payment\Response\ConnectPaymentPostAuthResponse;

class ConnectPaymentPostAuthResponseMapper extends PaymentPostAuthResponseMapper
{
    public static function newInstance()
    {
        return new ConnectPaymentPostAuthResponseMapper();
    }

    public function mapResponse(ConnectPaymentPostAuthResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);

        if (isset($jsonResult->connectorName)) {
            $response->setConnectorName($jsonResult->connectorName);
        }
    }
}