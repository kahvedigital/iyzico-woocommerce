<?php

namespace Iyzipay\Client\Service;

use Iyzipay\Client\Configuration\ClientConfiguration;
use Iyzipay\Client\Ecom\Onboarding\Request\CreateSubMerchantRequest;
use Iyzipay\Client\Ecom\Onboarding\Request\RetrieveSubMerchantRequest;
use Iyzipay\Client\Ecom\Onboarding\Request\UpdateSubMerchantRequest;
use Iyzipay\Client\Ecom\Onboarding\Response\CreateSubMerchantResponse;
use Iyzipay\Client\Ecom\Onboarding\Response\RetrieveSubMerchantResponse;
use Iyzipay\Client\Ecom\Onboarding\Response\UpdateSubMerchantResponse;
use Iyzipay\Client\HttpClientTemplate;

class OnboardingServiceClient extends BaseServiceClient
{
    public static function fromConfiguration(ClientConfiguration $configuration)
    {
        return new OnboardingServiceClient($configuration, new HttpClientTemplate());
    }

    public function getSubMerchant(RetrieveSubMerchantRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/onboarding/submerchant/detail", parent::getHttpHeader($request), $request->toJsonString());
        $response = new RetrieveSubMerchantResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }

    public function createSubMerchant(CreateSubMerchantRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/onboarding/submerchant", parent::getHttpHeader($request), $request->toJsonString());
        $response = new CreateSubMerchantResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }

    public function updateSubMerchant(UpdateSubMerchantRequest $request)
    {
        $rawResult = $this->httpClientTemplate->put($this->configuration->getBaseUrl() . "/onboarding/submerchant", parent::getHttpHeader($request), $request->toJsonString());
        $response = new UpdateSubMerchantResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }
}