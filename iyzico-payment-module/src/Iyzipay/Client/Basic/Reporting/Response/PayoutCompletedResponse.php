<?php

namespace Iyzipay\Client\Basic\Reporting\Response;

use Iyzipay\Client\Basic\Reporting\Response\Mapper\PayoutCompletedResponseMapper;
use Iyzipay\Client\Response;

class PayoutCompletedResponse extends Response
{
    private $payoutCompletedTransactions;

    public function getPayoutCompletedTransactions()
    {
        return $this->payoutCompletedTransactions;
    }

    public function setPayoutCompletedTransactions($payoutCompletedTransactions)
    {
        $this->payoutCompletedTransactions = $payoutCompletedTransactions;
    }

    public function fromJson($jsonResult)
    {
        PayoutCompletedResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}