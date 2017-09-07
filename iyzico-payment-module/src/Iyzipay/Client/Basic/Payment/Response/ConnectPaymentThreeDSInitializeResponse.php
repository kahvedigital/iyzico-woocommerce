<?php

namespace Iyzipay\Client\Basic\Payment\Response;

use Iyzipay\Client\Basic\Payment\Response\Mapper\ConnectPaymentThreeDSInitializeResponseMapper;

class ConnectPaymentThreeDSInitializeResponse extends PaymentThreeDSInitializeResponse
{
    public function fromJson($jsonResult)
    {
        ConnectPaymentThreeDSInitializeResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}