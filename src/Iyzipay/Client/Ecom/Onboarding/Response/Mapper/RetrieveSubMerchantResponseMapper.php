<?php

namespace Iyzipay\Client\Ecom\Onboarding\Response\Mapper;

use Iyzipay\Client\Ecom\Onboarding\Response\RetrieveSubMerchantResponse;
use Iyzipay\Client\ResponseMapper;

class RetrieveSubMerchantResponseMapper extends ResponseMapper
{
    public static function newInstance()
    {
        return new RetrieveSubMerchantResponseMapper();
    }

    public function mapResponse(RetrieveSubMerchantResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);

        if (isset($jsonResult->name)) {
            $response->setName($jsonResult->name);
        }
        if (isset($jsonResult->email)) {
            $response->setEmail($jsonResult->email);
        }
        if (isset($jsonResult->gsmNumber)) {
            $response->setGsmNumber($jsonResult->gsmNumber);
        }
        if (isset($jsonResult->address)) {
            $response->setAddress($jsonResult->address);
        }
        if (isset($jsonResult->iban)) {
            $response->setIban($jsonResult->iban);
        }
        if (isset($jsonResult->taxOffice)) {
            $response->setTaxOffice($jsonResult->taxOffice);
        }
        if (isset($jsonResult->contactName)) {
            $response->setContactName($jsonResult->contactName);
        }
        if (isset($jsonResult->contactSurname)) {
            $response->setContactSurname($jsonResult->contactSurname);
        }
        if (isset($jsonResult->legalCompanyTitle)) {
            $response->setLegalCompanyTitle($jsonResult->legalCompanyTitle);
        }
        if (isset($jsonResult->subMerchantExternalId)) {
            $response->setSubMerchantExternalId($jsonResult->subMerchantExternalId);
        }
        if (isset($jsonResult->identityNumber)) {
            $response->setIdentityNumber($jsonResult->identityNumber);
        }
        if (isset($jsonResult->taxNumber)) {
            $response->setTaxNumber($jsonResult->taxNumber);
        }
        if (isset($jsonResult->subMerchantType)) {
            $response->setSubMerchantType($jsonResult->subMerchantType);
        }
        if (isset($jsonResult->subMerchantKey)) {
            $response->setSubMerchantKey($jsonResult->subMerchantKey);
        }
    }
}