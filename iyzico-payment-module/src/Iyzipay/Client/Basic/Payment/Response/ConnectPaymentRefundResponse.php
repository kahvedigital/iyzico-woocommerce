<?php

namespace Iyzipay\Client\Basic\Payment\Response;

use Iyzipay\Client\Basic\Payment\Response\Mapper\ConnectPaymentRefundResponseMapper;

class ConnectPaymentRefundResponse extends PaymentRefundResponse
{
    private $connectorName;

    public function getConnectorName()
    {
        return $this->connectorName;
    }

    public function setConnectorName($connectorName)
    {
        $this->connectorName = $connectorName;
    }

    public function fromJson($jsonResult)
    {
        ConnectPaymentRefundResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}