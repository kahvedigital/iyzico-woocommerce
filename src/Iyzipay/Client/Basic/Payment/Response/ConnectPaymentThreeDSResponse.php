<?php

namespace Iyzipay\Client\Basic\Payment\Response;

use Iyzipay\Client\Basic\Payment\Response\Mapper\ConnectPaymentThreeDSResponseMapper;

class ConnectPaymentThreeDSResponse extends ConnectPaymentResponse
{
    public function fromJson($jsonResult)
    {
        ConnectPaymentThreeDSResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}