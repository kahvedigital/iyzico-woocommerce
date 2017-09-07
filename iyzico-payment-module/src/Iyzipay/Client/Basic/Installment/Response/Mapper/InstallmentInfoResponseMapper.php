<?php

namespace Iyzipay\Client\Basic\Installment\Response\Mapper;

use Iyzipay\Client\Basic\Installment\Dto\InstallmentDetailDto;
use Iyzipay\Client\Basic\Installment\Dto\InstallmentPriceDto;
use Iyzipay\Client\Basic\Installment\Response\InstallmentInfoResponse;
use Iyzipay\Client\ResponseMapper;

class InstallmentInfoResponseMapper extends ResponseMapper
{
    public static function newInstance()
    {
        return new InstallmentInfoResponseMapper();
    }

    public function mapResponse(InstallmentInfoResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);

        if (isset($jsonResult->installmentDetails)) {
            $response->setInstallmentDetails($this->mapInstallmentDetails($jsonResult->installmentDetails));
        }
    }

    private function mapInstallmentDetails($installmentDetails)
    {
        $installmentDetailDtoArray = array();

        foreach ($installmentDetails as $index => $installmentDetail) {
            $installmentDetailDto = new InstallmentDetailDto();
            if (isset($installmentDetail->binNumber)) {
                $installmentDetailDto->setBinNumber($installmentDetail->binNumber);
            }
            if (isset($installmentDetail->price)) {
                $installmentDetailDto->setPrice($installmentDetail->price);
            }
            if (isset($installmentDetail->cardType)) {
                $installmentDetailDto->setCardType($installmentDetail->cardType);
            }
            if (isset($installmentDetail->cardAssociation)) {
                $installmentDetailDto->setCardAssociation($installmentDetail->cardAssociation);
            }
            if (isset($installmentDetail->cardFamilyName)) {
                $installmentDetailDto->setCardFamilyName($installmentDetail->cardFamilyName);
            }
            if (isset($installmentDetail->force3ds)) {
                $installmentDetailDto->setForce3ds($installmentDetail->force3ds);
            }
            if (isset($installmentDetail->bankCode)) {
                $installmentDetailDto->setBankCode($installmentDetail->bankCode);
            }
            if (isset($installmentDetail->bankName)) {
                $installmentDetailDto->setBankName($installmentDetail->bankName);
            }
            if (isset($installmentDetail->installmentPrices)) {
                $installmentDetailDto->setInstallmentPrices($this->mapInstallmentPrices($installmentDetail->installmentPrices));
            }
            $installmentDetailDtoArray[$index] = $installmentDetailDto;
        }

        return $installmentDetailDtoArray;
    }

    private function mapInstallmentPrices($installmentPrices)
    {
        $installmentPriceDtoArray = array();

        foreach ($installmentPrices as $index => $installmentPrice) {
            $installmentPriceDto = new InstallmentPriceDto();
            if (isset($installmentPrice->installmentPrice)) {
                $installmentPriceDto->setInstallmentPrice($installmentPrice->installmentPrice);
            }
            if (isset($installmentPrice->totalPrice)) {
                $installmentPriceDto->setTotalPrice($installmentPrice->totalPrice);
            }
            if (isset($installmentPrice->installmentNumber)) {
                $installmentPriceDto->setInstallmentNumber($installmentPrice->installmentNumber);
            }
            $installmentPriceDtoArray[$index] = $installmentPriceDto;
        }

        return $installmentPriceDtoArray;
    }
}