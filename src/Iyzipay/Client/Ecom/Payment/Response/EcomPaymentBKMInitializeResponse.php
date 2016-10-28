<?php

namespace Iyzipay\Client\Ecom\Payment\Response;

use Iyzipay\Client\Ecom\Payment\Response\Mapper\EcomPaymentBKMInitializeResponseMapper;

class EcomPaymentBKMInitializeResponse extends EcomPaymentResponse
{
    private $htmlContent;

    public function getHtmlContent()
    {
        return $this->htmlContent;
    }

    public function setHtmlContent($htmlContent)
    {
        $this->htmlContent = $htmlContent;
    }

    public function fromJson($jsonResult)
    {
        EcomPaymentBKMInitializeResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}