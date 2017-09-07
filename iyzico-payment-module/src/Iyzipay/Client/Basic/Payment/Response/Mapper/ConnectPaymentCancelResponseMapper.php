<?php

namespace Iyzipay\Client\Basic\Payment\Response\Mapper;

use Iyzipay\Client\Basic\Payment\Response\ConnectPaymentCancelResponse;

class ConnectPaymentCancelResponseMapper extends PaymentCancelResponseMapper
{

    public static function newInstance()
    {
        return new ConnectPaymentCancelResponseMapper();
    }

    public function mapResponse(ConnectPaymentCancelResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);

        if (isset($jsonResult->connectorName)) {
            $response->setConnectorName($jsonResult->connectorName);
        }
    }
}