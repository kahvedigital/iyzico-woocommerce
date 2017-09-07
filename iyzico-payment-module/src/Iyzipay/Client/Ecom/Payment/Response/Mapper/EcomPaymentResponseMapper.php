<?php

namespace Iyzipay\Client\Ecom\Payment\Response\Mapper;

use Iyzipay\Client\Ecom\Payment\Dto\EcomPaymentItemTransactionDto;
use Iyzipay\Client\Ecom\Payment\Response\EcomPaymentResponse;
use Iyzipay\Client\ResponseMapper;

class EcomPaymentResponseMapper extends ResponseMapper
{
    public static function newInstance()
    {
        return new EcomPaymentResponseMapper();
    }

    public function mapResponse(EcomPaymentResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);

        if (isset($jsonResult->price)) {
            $response->setPrice($jsonResult->price);
        }
        if (isset($jsonResult->paidPrice)) {
            $response->setPaidPrice($jsonResult->paidPrice);
        }
        if (isset($jsonResult->basketId)) {
            $response->setBasketId($jsonResult->basketId);
        }
        if (isset($jsonResult->installment)) {
            $response->setInstallment($jsonResult->installment);
        }
        if (isset($jsonResult->paymentId)) {
            $response->setPaymentId($jsonResult->paymentId);
        }
        if (isset($jsonResult->fraudStatus)) {
            $response->setFraudStatus($jsonResult->fraudStatus);
        }
        if (isset($jsonResult->merchantCommissionRate)) {
            $response->setMerchantCommissionRate($jsonResult->merchantCommissionRate);
        }
        if (isset($jsonResult->merchantCommissionRateAmount)) {
            $response->setMerchantCommissionRateAmount($jsonResult->merchantCommissionRateAmount);
        }
        if (isset($jsonResult->iyziCommissionRateAmount)) {
            $response->setIyziCommissionRateAmount($jsonResult->iyziCommissionRateAmount);
        }
        if (isset($jsonResult->iyziCommissionFee)) {
            $response->setIyziCommissionFee($jsonResult->iyziCommissionFee);
        }
        if (isset($jsonResult->cardType)) {
            $response->setCardType($jsonResult->cardType);
        }
        if (isset($jsonResult->cardAssociation)) {
            $response->setCardAssociation($jsonResult->cardAssociation);
        }
        if (isset($jsonResult->cardFamily)) {
            $response->setCardFamily($jsonResult->cardFamily);
        }
        if (isset($jsonResult->cardToken)) {
            $response->setCardToken($jsonResult->cardToken);
        }
        if (isset($jsonResult->cardUserKey)) {
            $response->setCardUserKey($jsonResult->cardUserKey);
        }
        if (isset($jsonResult->binNumber)) {
            $response->setBinNumber($jsonResult->binNumber);
        }
        if (isset($jsonResult->itemTransactions)) {
            $response->setItemTransactions($this->mapPaymentItemTransactions($jsonResult->itemTransactions));
        }
    }

    private function mapPaymentItemTransactions($itemTransactions)
    {
        $itemTransactionDtoArray = array();

        foreach ($itemTransactions as $index => $itemTransaction) {
            $itemTransactionDto = new EcomPaymentItemTransactionDto();
            if (isset($itemTransaction->itemId)) {
                $itemTransactionDto->setItemId($itemTransaction->itemId);
            }
            if (isset($itemTransaction->paymentTransactionId)) {
                $itemTransactionDto->setPaymentTransactionId($itemTransaction->paymentTransactionId);
            }
            if (isset($itemTransaction->transactionStatus)) {
                $itemTransactionDto->setTransactionStatus($itemTransaction->transactionStatus);
            }
            if (isset($itemTransaction->price)) {
                $itemTransactionDto->setPrice($itemTransaction->price);
            }
            if (isset($itemTransaction->paidPrice)) {
                $itemTransactionDto->setPaidPrice($itemTransaction->paidPrice);
            }
            if (isset($itemTransaction->merchantCommissionRate)) {
                $itemTransactionDto->setMerchantCommissionRate($itemTransaction->merchantCommissionRate);
            }
            if (isset($itemTransaction->merchantCommissionRateAmount)) {
                $itemTransactionDto->setMerchantCommissionRateAmount($itemTransaction->merchantCommissionRateAmount);
            }
            if (isset($itemTransaction->iyziCommissionRateAmount)) {
                $itemTransactionDto->setIyziCommissionRateAmount($itemTransaction->iyziCommissionRateAmount);
            }
            if (isset($itemTransaction->iyziCommissionFee)) {
                $itemTransactionDto->setIyziCommissionFee($itemTransaction->iyziCommissionFee);
            }
            if (isset($itemTransaction->blockageRate)) {
                $itemTransactionDto->setBlockageRate($itemTransaction->blockageRate);
            }
            if (isset($itemTransaction->blockageRateAmountMerchant)) {
                $itemTransactionDto->setBlockageRateAmountMerchant($itemTransaction->blockageRateAmountMerchant);
            }
            if (isset($itemTransaction->blockageRateAmountSubMerchant)) {
                $itemTransactionDto->setBlockageRateAmountSubMerchant($itemTransaction->blockageRateAmountSubMerchant);
            }
            if (isset($itemTransaction->blockageResolvedDate)) {
                $itemTransactionDto->setBlockageResolvedDate($itemTransaction->blockageResolvedDate);
            }
            if (isset($itemTransaction->subMerchantKey)) {
                $itemTransactionDto->setSubMerchantKey($itemTransaction->subMerchantKey);
            }
            if (isset($itemTransaction->subMerchantPrice)) {
                $itemTransactionDto->setSubMerchantPrice($itemTransaction->subMerchantPrice);
            }
            if (isset($itemTransaction->subMerchantPayoutRate)) {
                $itemTransactionDto->setSubMerchantPayoutRate($itemTransaction->subMerchantPayoutRate);
            }
            if (isset($itemTransaction->subMerchantPayoutAmount)) {
                $itemTransactionDto->setSubMerchantPayoutAmount($itemTransaction->subMerchantPayoutAmount);
            }
            if (isset($itemTransaction->merchantPayoutAmount)) {
                $itemTransactionDto->setMerchantPayoutAmount($itemTransaction->merchantPayoutAmount);
            }
            $itemTransactionDtoArray[$index] = $itemTransactionDto;
        }

        return $itemTransactionDtoArray;
    }
}