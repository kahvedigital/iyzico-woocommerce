<?php

namespace Iyzipay\Client\Service;

use Iyzipay\Client\Basic\Bin\Request\BinCheckRequest;
use Iyzipay\Client\Basic\Bin\Response\BinCheckResponse;
use Iyzipay\Client\Configuration\ClientConfiguration;
use Iyzipay\Client\HttpClientTemplate;
use Iyzipay\Client\Response;

class BasePaymentServiceClient extends BaseServiceClient
{
    public static function fromConfiguration(ClientConfiguration $configuration)
    {
        return new BasePaymentServiceClient($configuration, new HttpClientTemplate());
    }

    public function test()
    {
        $rawResult = $this->httpClientTemplate->get($this->configuration->getBaseUrl() . "/payment/test", parent::getPlainHttpHeader());
        $response = new Response();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }

    public function checkBin(BinCheckRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/payment/bin/check", parent::getHttpHeader($request), $request->toJsonString());
        $response = new BinCheckResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }
}