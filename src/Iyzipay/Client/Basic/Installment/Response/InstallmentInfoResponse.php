<?php

namespace Iyzipay\Client\Basic\Installment\Response;

use Iyzipay\Client\Basic\Installment\Response\Mapper\InstallmentInfoResponseMapper;
use Iyzipay\Client\Response;

class InstallmentInfoResponse extends Response
{
    private $installmentDetails;

    public function getInstallmentDetails()
    {
        return $this->installmentDetails;
    }

    public function setInstallmentDetails($installmentDetails)
    {
        $this->installmentDetails = $installmentDetails;
    }

    public function fromJson($jsonResult)
    {
        InstallmentInfoResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}