<?php

namespace Iyzipay\Client\Service;

use Iyzipay\Client\CardStorage\Request\CreateCardRequest;
use Iyzipay\Client\CardStorage\Request\DeleteCardRequest;
use Iyzipay\Client\CardStorage\Request\RetrieveCardListRequest;
use Iyzipay\Client\CardStorage\Response\CreateCardResponse;
use Iyzipay\Client\CardStorage\Response\DeleteCardResponse;
use Iyzipay\Client\CardStorage\Response\RetrieveCardListResponse;
use Iyzipay\Client\Configuration\ClientConfiguration;
use Iyzipay\Client\HttpClientTemplate;

class CardStorageServiceClient extends BaseServiceClient
{
    public static function fromConfiguration(ClientConfiguration $configuration)
    {
        return new CardStorageServiceClient($configuration, new HttpClientTemplate());
    }

    public function createCard(CreateCardRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/cardstorage/card", parent::getHttpHeader($request), $request->toJsonString());
        $response = new CreateCardResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }

    public function deleteCard(DeleteCardRequest $request)
    {
        $rawResult = $this->httpClientTemplate->delete($this->configuration->getBaseUrl() . "/cardstorage/card", parent::getHttpHeader($request), $request->toJsonString());
        $response = new DeleteCardResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }

    public function getCards(RetrieveCardListRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/cardstorage/cards", parent::getHttpHeader($request), $request->toJsonString());
        $response = new RetrieveCardListResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }
}