<?php

namespace Iyzipay\Client\Service;

use Iyzipay\Client\Configuration\ClientConfiguration;
use Iyzipay\Client\Ecom\Payment\Request\EcomPaymentCheckoutFormInitializeRequest;
use Iyzipay\Client\Ecom\Payment\Request\EcomRetrievePaymentCheckoutFormAuthRequest;
use Iyzipay\Client\Ecom\Payment\Response\EcomPaymentCheckoutFormInitializeResponse;
use Iyzipay\Client\Ecom\Payment\Response\EcomRetrievePaymentCheckoutFormAuthResponse;
use Iyzipay\Client\HttpClientTemplate;

class EcomCheckoutFormServiceClient extends BasePaymentServiceClient
{
    public static function fromConfiguration(ClientConfiguration $configuration)
    {
        return new EcomCheckoutFormServiceClient($configuration, new HttpClientTemplate());
    }

    public function initializeCheckoutForm(EcomPaymentCheckoutFormInitializeRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/payment/iyzipos/checkoutform/initialize/ecom", parent::getHttpHeader($request), $request->toJsonString());
        $response = new EcomPaymentCheckoutFormInitializeResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }

    public function getAuthResponse(EcomRetrievePaymentCheckoutFormAuthRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/payment/iyzipos/checkoutform/auth/ecom/detail", parent::getHttpHeader($request), $request->toJsonString());
        $response = new EcomRetrievePaymentCheckoutFormAuthResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }
}