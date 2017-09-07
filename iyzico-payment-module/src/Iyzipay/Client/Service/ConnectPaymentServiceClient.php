<?php

namespace Iyzipay\Client\Service;

use Iyzipay\Client\Basic\Payment\Request\ConnectPaymentAuthRequest;
use Iyzipay\Client\Basic\Payment\Request\ConnectPaymentCancelRequest;
use Iyzipay\Client\Basic\Payment\Request\ConnectPaymentPostAuthRequest;
use Iyzipay\Client\Basic\Payment\Request\ConnectPaymentPreAuthRequest;
use Iyzipay\Client\Basic\Payment\Request\ConnectPaymentRefundRequest;
use Iyzipay\Client\Basic\Payment\Request\ConnectPaymentThreeDSInitializeRequest;
use Iyzipay\Client\Basic\Payment\Request\ConnectPaymentThreeDSRequest;
use Iyzipay\Client\Basic\Payment\Response\ConnectPaymentAuthResponse;
use Iyzipay\Client\Basic\Payment\Response\ConnectPaymentCancelResponse;
use Iyzipay\Client\Basic\Payment\Response\ConnectPaymentPostAuthResponse;
use Iyzipay\Client\Basic\Payment\Response\ConnectPaymentPreAuthResponse;
use Iyzipay\Client\Basic\Payment\Response\ConnectPaymentRefundResponse;
use Iyzipay\Client\Basic\Payment\Response\ConnectPaymentThreeDSInitializeResponse;
use Iyzipay\Client\Basic\Payment\Response\ConnectPaymentThreeDSResponse;
use Iyzipay\Client\Configuration\ClientConfiguration;
use Iyzipay\Client\HttpClientTemplate;

class ConnectPaymentServiceClient extends BasePaymentServiceClient
{
    public static function fromConfiguration(ClientConfiguration $configuration)
    {
        return new ConnectPaymentServiceClient($configuration, new HttpClientTemplate());
    }

    public function auth(ConnectPaymentAuthRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/payment/iyziconnect/auth", parent::getHttpHeader($request), $request->toJsonString());
        $response = new ConnectPaymentAuthResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }

    public function preAuth(ConnectPaymentPreAuthRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/payment/iyziconnect/preauth", parent::getHttpHeader($request), $request->toJsonString());
        $response = new ConnectPaymentPreAuthResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }

    public function postAuth(ConnectPaymentPostAuthRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/payment/iyziconnect/postauth", parent::getHttpHeader($request), $request->toJsonString());
        $response = new ConnectPaymentPostAuthResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }

    public function refund(ConnectPaymentRefundRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/payment/iyziconnect/refund", parent::getHttpHeader($request), $request->toJsonString());
        $response = new ConnectPaymentRefundResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }

    public function cancel(ConnectPaymentCancelRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/payment/iyziconnect/cancel", parent::getHttpHeader($request), $request->toJsonString());
        $response = new ConnectPaymentCancelResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }

    public function initializeThreeDS(ConnectPaymentThreeDSInitializeRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/payment/iyziconnect/initialize3ds", parent::getHttpHeader($request), $request->toJsonString());
        $response = new ConnectPaymentThreeDSInitializeResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }

    public function threeDSAuth(ConnectPaymentThreeDSRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/payment/iyziconnect/auth3ds", parent::getHttpHeader($request), $request->toJsonString());
        $response = new ConnectPaymentThreeDSResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }
}