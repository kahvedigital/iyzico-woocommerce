<?php

namespace Iyzipay\Client\Basic\Payment\Response;

use Iyzipay\Client\Basic\Payment\Response\Mapper\ConnectPaymentPostAuthResponseMapper;

class ConnectPaymentPostAuthResponse extends PaymentPostAuthResponse
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
        ConnectPaymentPostAuthResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}