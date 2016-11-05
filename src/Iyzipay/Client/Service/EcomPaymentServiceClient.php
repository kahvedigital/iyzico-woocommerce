<?php

namespace Iyzipay\Client\Service;

use Iyzipay\Client\Basic\Installment\Request\InstallmentInfoRequest;
use Iyzipay\Client\Basic\Installment\Response\InstallmentInfoResponse;
use Iyzipay\Client\Basic\Payment\Request\PaymentCancelRequest;
use Iyzipay\Client\Basic\Payment\Request\PaymentPostAuthRequest;
use Iyzipay\Client\Basic\Payment\Request\PaymentRefundRequest;
use Iyzipay\Client\Basic\Payment\Response\PaymentCancelResponse;
use Iyzipay\Client\Basic\Payment\Response\PaymentPostAuthResponse;
use Iyzipay\Client\Basic\Payment\Response\PaymentRefundResponse;
use Iyzipay\Client\Configuration\ClientConfiguration;
use Iyzipay\Client\Ecom\Approval\Request\ApprovalRequest;
use Iyzipay\Client\Ecom\Approval\Response\ApprovalResponse;
use Iyzipay\Client\Ecom\Payment\Request\EcomPaymentAuthRequest;
use Iyzipay\Client\Ecom\Payment\Request\EcomPaymentBKMInitializeRequest;
use Iyzipay\Client\Ecom\Payment\Request\EcomPaymentPreAuthRequest;
use Iyzipay\Client\Ecom\Payment\Request\EcomPaymentThreeDSInitializeRequest;
use Iyzipay\Client\Ecom\Payment\Request\EcomPaymentThreeDSRequest;
use Iyzipay\Client\Ecom\Payment\Request\EcomRetrievePaymentBKMAuthRequest;
use Iyzipay\Client\Ecom\Payment\Response\EcomPaymentAuthResponse;
use Iyzipay\Client\Ecom\Payment\Response\EcomPaymentPreAuthResponse;
use Iyzipay\Client\Ecom\Payment\Response\EcomPaymentThreeDSInitializeResponse;
use Iyzipay\Client\Ecom\Payment\Response\EcomPaymentThreeDSResponse;
use Iyzipay\Client\Ecom\Payment\Response\EcomPaymentBKMInitializeResponse;
use Iyzipay\Client\Ecom\Payment\Response\EcomRetrievePaymentBKMAuthResponse;
use Iyzipay\Client\HttpClientTemplate;

class EcomPaymentServiceClient extends BasePaymentServiceClient
{
    public static function fromConfiguration(ClientConfiguration $configuration)
    {
        return new EcomPaymentServiceClient($configuration, new HttpClientTemplate());
    }

    public function getInstallmentInfo(InstallmentInfoRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/payment/iyzipos/installment", parent::getHttpHeader($request), $request->toJsonString());
        $response = new InstallmentInfoResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }

    public function approve(ApprovalRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/payment/iyzipos/item/approve", parent::getHttpHeader($request), $request->toJsonString());
        $response = new ApprovalResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }

    public function disapprove(ApprovalRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/payment/iyzipos/item/disapprove", parent::getHttpHeader($request), $request->toJsonString());
        $response = new ApprovalResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }

    public function auth(EcomPaymentAuthRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/payment/iyzipos/auth/ecom", parent::getHttpHeader($request), $request->toJsonString());
        $response = new EcomPaymentAuthResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }

    public function preAuth(EcomPaymentPreAuthRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/payment/iyzipos/preauth/ecom", parent::getHttpHeader($request), $request->toJsonString());
        $response = new EcomPaymentPreAuthResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }

    public function postAuth(PaymentPostAuthRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/payment/iyzipos/postauth", parent::getHttpHeader($request), $request->toJsonString());
        $response = new PaymentPostAuthResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }

    public function refund(PaymentRefundRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/payment/iyzipos/refund", parent::getHttpHeader($request), $request->toJsonString());
        $response = new PaymentRefundResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }

    public function refundChargedFromMerchant(PaymentRefundRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/payment/iyzipos/refund/merchant/charge", parent::getHttpHeader($request), $request->toJsonString());
        $response = new PaymentRefundResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }

    public function cancel(PaymentCancelRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/payment/iyzipos/cancel", parent::getHttpHeader($request), $request->toJsonString());
        $response = new PaymentCancelResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }

    public function initializeThreeDS(EcomPaymentThreeDSInitializeRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/payment/iyzipos/initialize3ds/ecom", parent::getHttpHeader($request), $request->toJsonString());
        $response = new EcomPaymentThreeDSInitializeResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }

    public function threeDSAuth(EcomPaymentThreeDSRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/payment/iyzipos/auth3ds/ecom", parent::getHttpHeader($request), $request->toJsonString());
        $response = new EcomPaymentThreeDSResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }

    public function initializeBKM(EcomPaymentBKMInitializeRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/payment/iyzipos/initializebkm/ecom", parent::getHttpHeader($request), $request->toJsonString());
        $response = new EcomPaymentBKMInitializeResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }

    public function getBKMAuthResponse(EcomRetrievePaymentBKMAuthRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/payment/iyzipos/bkm/auth/ecom/detail", parent::getHttpHeader($request), $request->toJsonString());
        $response = new EcomRetrievePaymentBKMAuthResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }
}