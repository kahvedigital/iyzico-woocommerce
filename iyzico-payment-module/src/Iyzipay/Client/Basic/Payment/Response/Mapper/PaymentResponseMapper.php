<?php

namespace Iyzipay\Client\Basic\Payment\Response\Mapper;

use Iyzipay\Client\Basic\Payment\Response\PaymentResponse;
use Iyzipay\Client\ResponseMapper;

class PaymentResponseMapper extends ResponseMapper
{
    public static function newInstance()
    {
        return new PaymentResponseMapper();
    }

    public function mapResponse(PaymentResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);

        if (isset($jsonResult->price)) {
            $response->setPrice($jsonResult->price);
        }
        if (isset($jsonResult->paidPrice)) {
            $response->setPaidPrice($jsonResult->paidPrice);
        }
        if (isset($jsonResult->installment)) {
            $response->setInstallment($jsonResult->installment);
        }
        if (isset($jsonResult->paymentId)) {
            $response->setPaymentId($jsonResult->paymentId);
        }
        if (isset($jsonResult->merchantCommissionRate)) {
            $response->setMerchantCommissionRate($jsonResult->merchantCommissionRate);
        }
        if (isset($jsonResult->merchantCommissionRateAmount)) {
            $response->setMerchantCommissionRateAmount($jsonResult->merchantCommissionRateAmount);
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
        if (isset($jsonResult->paymentTransactionId)) {
            $response->setPaymentTransactionId($jsonResult->paymentTransactionId);
        }
    }
}