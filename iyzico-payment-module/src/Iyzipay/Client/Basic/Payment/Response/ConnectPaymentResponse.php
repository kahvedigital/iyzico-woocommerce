<?php

namespace Iyzipay\Client\Basic\Payment\Response;

use Iyzipay\Client\Basic\Payment\Response\Mapper\ConnectPaymentResponseMapper;

class ConnectPaymentResponse extends PaymentResponse
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
        ConnectPaymentResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}