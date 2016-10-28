<?php

namespace Iyzipay\Client\Basic\Payment\Response;

use Iyzipay\Client\Basic\Payment\Response\Mapper\ConnectPaymentPreAuthResponseMapper;

class ConnectPaymentPreAuthResponse extends ConnectPaymentResponse
{
    public function fromJson($jsonResult)
    {
        ConnectPaymentPreAuthResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}