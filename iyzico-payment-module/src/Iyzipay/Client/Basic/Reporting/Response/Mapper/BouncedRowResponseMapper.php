<?php

namespace Iyzipay\Client\Basic\Reporting\Response\Mapper;

use Iyzipay\Client\Basic\Reporting\Dto\BouncedRowDto;
use Iyzipay\Client\Basic\Reporting\Response\BouncedRowResponse;
use Iyzipay\Client\ResponseMapper;

class BouncedRowResponseMapper extends ResponseMapper
{
    public static function newInstance()
    {
        return new BouncedRowResponseMapper();
    }

    public function mapResponse(BouncedRowResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);

        if (isset($jsonResult->bouncedRows)) {
            $response->setBouncedRows($this->mapBouncedRows($jsonResult->bouncedRows));
        }
    }

    private function mapBouncedRows($bouncedRows)
    {
        $bouncedRowDtoArray = array();

        foreach ($bouncedRows as $index => $bouncedRow) {
            $bouncedRowDto = new BouncedRowDto();
            if (isset($bouncedRows->subMerchantKey)) {
                $bouncedRowDto->setSubMerchantKey($bouncedRow->submerchantKey);
            }
            if (isset($bouncedRows->iban)) {
                $bouncedRowDto->setIban($bouncedRow->iban);
            }
            if (isset($bouncedRows->contactName)) {
                $bouncedRowDto->setContactName($bouncedRow->contactName);
            }
            if (isset($bouncedRows->contactSurname)) {
                $bouncedRowDto->setContactSurname($bouncedRow->contactSurname);
            }
            if (isset($bouncedRows->legalCompanyTitle)) {
                $bouncedRowDto->setLegalCompanyTitle($bouncedRow->legalCompanyTitle);
            }
            if (isset($bouncedRows->marketplaceSubmerchantType)) {
                $bouncedRowDto->setMarketplaceSubmerchantType($bouncedRow->marketplaceSubmerchantType);
            }
            $bouncedRowDtoArray[$index] = $bouncedRowDto;
        }

        return $bouncedRowDtoArray;
    }
}