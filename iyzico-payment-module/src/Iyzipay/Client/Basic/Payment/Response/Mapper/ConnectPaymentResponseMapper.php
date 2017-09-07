<?php

namespace Iyzipay\Client\Basic\Payment\Response\Mapper;

use Iyzipay\Client\Basic\Payment\Response\ConnectPaymentResponse;

class ConnectPaymentResponseMapper extends PaymentResponseMapper
{

    public static function newInstance()
    {
        return new ConnectPaymentResponseMapper();
    }

    public function mapResponse(ConnectPaymentResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);

        if (isset($jsonResult->connectorName)) {
            $response->setConnectorName($jsonResult->connectorName);
        }
    }
}