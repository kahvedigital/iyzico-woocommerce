<?php

namespace Iyzipay\Client\Ecom\Approval\Response\Mapper;

use Iyzipay\Client\Ecom\Approval\Response\ApprovalResponse;
use Iyzipay\Client\ResponseMapper;

class ApprovalResponseMapper extends ResponseMapper
{
    public static function newInstance()
    {
        return new ApprovalResponseMapper();
    }

    public function mapResponse(ApprovalResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);

        if (isset($jsonResult->paymentTransactionId)) {
            $response->setPaymentTransactionId($jsonResult->paymentTransactionId);
        }
    }
}