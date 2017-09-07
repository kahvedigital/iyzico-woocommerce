<?php

namespace Iyzipay\Client\Basic\Payment\Response;

use Iyzipay\Client\Basic\Payment\Response\Mapper\PaymentThreeDSInitializeResponseMapper;
use Iyzipay\Client\Response;

class PaymentThreeDSInitializeResponse extends Response
{
    private $threeDSHtmlContent;

    public function getThreeDSHtmlContent()
    {
        return $this->threeDSHtmlContent;
    }

    public function setThreeDSHtmlContent($threeDSHtmlContent)
    {
        $this->threeDSHtmlContent = $threeDSHtmlContent;
    }

    public function fromJson($jsonResult)
    {
        PaymentThreeDSInitializeResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}