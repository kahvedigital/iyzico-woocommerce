<?php

namespace Iyzipay\Client\Service;

use Iyzipay\Client\Configuration\ClientConfiguration;
use Iyzipay\Client\Digest;
use Iyzipay\Client\HttpClientTemplate;
use Iyzipay\Client\RandomStringGenerator;
use Iyzipay\Client\Request;
use Iyzipay\Client\RequestHelper;
use Iyzipay\Client\Response;

class BaseServiceClient
{
    protected $configuration;
    protected $httpClientTemplate;

    function __construct(ClientConfiguration $configuration, HttpClientTemplate $httpClientTemplate)
    {
        $this->configuration = $configuration;
        $this->httpClientTemplate = $httpClientTemplate;
    }

    protected function getHttpHeader(Request $request = null, $authorizeRequest = true)
    {
        $header = array(
            "Accept: application/json",
            "Content-type: application/json",
        );

        if ($authorizeRequest == true) {
            $randomHeaderValue = RandomStringGenerator::randomString(RequestHelper::RANDOM_STRING_SIZE);
            array_push($header, "Authorization: " . $this->prepareAuthorizationString($request, $randomHeaderValue));
            array_push($header, "x-iyzi-rnd: " . $randomHeaderValue);
        }

        return $header;
    }

    protected function getPlainHttpHeader()
    {
        return $this->getHttpHeader(null, false);
    }

    protected function jsonDecodeAndPrepareResponse(Response $response, $rawResult)
    {
        $jsonResult = json_decode($rawResult);
        $response->setRawResult($rawResult);
        $response->fromJson($jsonResult);
    }

    private function prepareAuthorizationString(Request $request, $randomHeaderValue)
    {
        $hash = $this->calculateHash($request, $randomHeaderValue);
        return RequestHelper::formatHeaderString(array($this->configuration->getApiKey(), $hash));
    }

    private function calculateHash(Request $request, $randomHeaderValue)
    {
        $hashStr = $this->configuration->getApiKey() . $randomHeaderValue . $this->configuration->getSecretKey() . $request->toPKIRequestString();
        return Digest::hash($hashStr);
    }
}