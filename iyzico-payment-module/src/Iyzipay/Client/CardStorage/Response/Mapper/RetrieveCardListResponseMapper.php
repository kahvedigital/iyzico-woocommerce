<?php

namespace Iyzipay\Client\CardStorage\Response\Mapper;

use Iyzipay\Client\CardStorage\Dto\CardDetailDto;
use Iyzipay\Client\CardStorage\Response\RetrieveCardListResponse;
use Iyzipay\Client\ResponseMapper;

class RetrieveCardListResponseMapper extends ResponseMapper
{
    public static function newInstance()
    {
        return new RetrieveCardListResponseMapper();
    }

    public function mapResponse(RetrieveCardListResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);

        if (isset($jsonResult->cardUserKey)) {
            $response->setCardUserKey($jsonResult->cardUserKey);
        }
        if (isset($jsonResult->cardDetails)) {
            $response->setCardDetails($this->mapCardDetails($jsonResult->cardDetails));
        }
    }

    public function mapCardDetails($cardDetails)
    {
        $cardDetailDtoArray = array();

        foreach ($cardDetails as $index => $cardDetail) {
            $cardDetailDto = new CardDetailDto();
            if (isset($cardDetail->cardToken)) {
                $cardDetailDto->setCardToken($cardDetail->cardToken);
            }
            if (isset($cardDetail->cardAlias)) {
                $cardDetailDto->setCardAlias($cardDetail->cardAlias);
            }
            if (isset($cardDetail->binNumber)) {
                $cardDetailDto->setBinNumber($cardDetail->binNumber);
            }
            if (isset($cardDetail->cardType)) {
                $cardDetailDto->setCardType($cardDetail->cardType);
            }
            if (isset($cardDetail->cardAssociation)) {
                $cardDetailDto->setCardAssociation($cardDetail->cardAssociation);
            }
            if (isset($cardDetail->cardFamily)) {
                $cardDetailDto->setCardFamily($cardDetail->cardFamily);
            }
            if (isset($cardDetail->cardBankCode)) {
                $cardDetailDto->setCardBankCode($cardDetail->cardBankCode);
            }
            if (isset($cardDetail->cardBankName)) {
                $cardDetailDto->setCardBankName($cardDetail->cardBankName);
            }
            $cardDetailDtoArray[$index] = $cardDetailDto;
        }

        return $cardDetailDtoArray;
    }
}
