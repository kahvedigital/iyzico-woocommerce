<?php

namespace Iyzipay\Client\Ecom\Payment\Response;

use Iyzipay\Client\Ecom\Payment\Response\Mapper\EcomPaymentThreeDSInitializeResponseMapper;
use Iyzipay\Client\Response;

class EcomPaymentThreeDSInitializeResponse extends Response
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
        EcomPaymentThreeDSInitializeResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}