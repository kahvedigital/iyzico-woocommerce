<?php

namespace Iyzipay\Client\Basic\Reporting\Response\Mapper;

use Iyzipay\Client\Basic\Reporting\Dto\PayoutCompletedTxDto;
use Iyzipay\Client\Basic\Reporting\Response\PayoutCompletedResponse;
use Iyzipay\Client\ResponseMapper;

class PayoutCompletedResponseMapper extends ResponseMapper
{
    public static function newInstance()
    {
        return new PayoutCompletedResponseMapper();
    }

    public function mapResponse(PayoutCompletedResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);

        if (isset($jsonResult->payoutCompletedTransactions)) {
            $response->setPayoutCompletedTransactions($this->mapPayoutCompletedTransactions($jsonResult->payoutCompletedTransactions));
        }
    }

    private function mapPayoutCompletedTransactions($payoutCompletedTransactions)
    {
        $payoutCompletedTransactionDtoArray = array();

        foreach ($payoutCompletedTransactions as $index => $payoutCompletedTransaction) {
            $payoutCompletedTransactionDto = new PayoutCompletedTxDto();
            if (isset($payoutCompletedTransaction->paymentTransactionId)) {
                $payoutCompletedTransactionDto->setPaymentTransactionId($payoutCompletedTransaction->paymentTransactionId);
            }
            if (isset($payoutCompletedTransaction->payoutAmount)) {
                $payoutCompletedTransactionDto->setPayoutAmount($payoutCompletedTransaction->payoutAmount);
            }
            if (isset($payoutCompletedTransaction->payoutType)) {
                $payoutCompletedTransactionDto->setPayoutType($payoutCompletedTransaction->payoutType);
            }
            if (isset($payoutCompletedTransaction->subMerchantKey)) {
                $payoutCompletedTransactionDto->setSubMerchantKey($payoutCompletedTransaction->subMerchantKey);
            }
            $payoutCompletedTransactionDtoArray[$index] = $payoutCompletedTransactionDto;
        }

        return $payoutCompletedTransactionDtoArray;
    }
}