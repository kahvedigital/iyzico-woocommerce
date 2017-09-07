<?php

namespace Iyzipay\Client\Service;

use Iyzipay\Client\Basic\Reporting\Request\BouncedRowRequest;
use Iyzipay\Client\Basic\Reporting\Request\PayoutCompletedRequest;
use Iyzipay\Client\Basic\Reporting\Response\BouncedRowResponse;
use Iyzipay\Client\Basic\Reporting\Response\PayoutCompletedResponse;
use Iyzipay\Client\Configuration\ClientConfiguration;
use Iyzipay\Client\HttpClientTemplate;

class ReportingServiceClient extends BaseServiceClient
{
    public static function fromConfiguration(ClientConfiguration $configuration)
    {
        return new ReportingServiceClient($configuration, new HttpClientTemplate());
    }

    public function getPayoutCompletedTransactions(PayoutCompletedRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/reporting/settlement/payoutcompleted", parent::getHttpHeader($request), $request->toJsonString());
        $response = new PayoutCompletedResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }

    public function getBouncedRows(BouncedRowRequest $request)
    {
        $rawResult = $this->httpClientTemplate->post($this->configuration->getBaseUrl() . "/reporting/settlement/bounced", parent::getHttpHeader($request), $request->toJsonString());
        $response = new BouncedRowResponse();
        parent::jsonDecodeAndPrepareResponse($response, $rawResult);
        return $response;
    }
}