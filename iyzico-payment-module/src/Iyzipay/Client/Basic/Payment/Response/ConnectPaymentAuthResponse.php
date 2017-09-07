<?php

namespace Iyzipay\Client\Basic\Payment\Response;

use Iyzipay\Client\Basic\Payment\Response\Mapper\ConnectPaymentAuthResponseMapper;

class ConnectPaymentAuthResponse extends ConnectPaymentResponse
{
    public function fromJson($jsonResult)
    {
        ConnectPaymentAuthResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}