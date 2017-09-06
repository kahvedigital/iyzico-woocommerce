<?php

namespace Iyzipay\Client\Ecom\Approval\Response;

use Iyzipay\Client\Ecom\Approval\Response\Mapper\ApprovalResponseMapper;
use Iyzipay\Client\Response;

class ApprovalResponse extends Response
{
    private $paymentTransactionId;

    public function getPaymentTransactionId()
    {
        return $this->paymentTransactionId;
    }

    public function setPaymentTransactionId($paymentTransactionId)
    {
        $this->paymentTransactionId = $paymentTransactionId;
    }

    public function fromJson($jsonResult)
    {
        ApprovalResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}