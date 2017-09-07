<?php

namespace Iyzipay\Client\Service;

use Iyzipay\Client\Configuration\ClientConfiguration;
use Iyzipay\Client\Ecom\CrossBooking\Request\CrossBookingRequest;
use Iyzipay\Client\Ecom\CrossBooking\Response\CrossBookingResponse;
use Iyzipay\Client\HttpClientTemplate;

class CrossBookingServiceClient extends BaseServiceClient
{
    public static function fromConfiguration(ClientConfiguration $configuration)
    {
        return new CrossBookingServiceClient($configuration, new HttpClientTemplate());
    }

    public function sendToSubMerchant(CrossBookingRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/crossbooking/send", parent::getHttpHeader($request), $request->toJsonString());
        $response = new CrossBookingResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }

    public function receiveFromSubMerchant(CrossBookingRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/crossbooking/receive", parent::getHttpHeader($request), $request->toJsonString());
        $response = new CrossBookingResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }
}