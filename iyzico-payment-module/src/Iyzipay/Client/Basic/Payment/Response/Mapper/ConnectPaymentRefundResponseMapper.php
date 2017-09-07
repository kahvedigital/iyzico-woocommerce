<?php

namespace Iyzipay\Client\Basic\Payment\Response\Mapper;

use Iyzipay\Client\Basic\Payment\Response\ConnectPaymentRefundResponse;

class ConnectPaymentRefundResponseMapper extends PaymentRefundResponseMapper
{
    public static function newInstance()
    {
        return new ConnectPaymentRefundResponseMapper();
    }

    public function mapResponse(ConnectPaymentRefundResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);

        if (isset($jsonResult->connectorName)) {
            $response->setConnectorName($jsonResult->connectorName);
        }
    }
}