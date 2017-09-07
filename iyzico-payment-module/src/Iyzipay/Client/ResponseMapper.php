<?php

namespace Iyzipay\Client;

class ResponseMapper
{
    public static function newInstance()
    {
        return new ResponseMapper();
    }

    public function mapResponse(Response $response, $jsonResult)
    {
        if (isset($jsonResult->status)) {
            $response->setStatus($jsonResult->status);
        }
        if (isset($jsonResult->conversationId)) {
            $response->setConversationId($jsonResult->conversationId);
        }
        if (isset($jsonResult->errorCode)) {
            $response->setErrorCode($jsonResult->errorCode);
        }
        if (isset($jsonResult->errorMessage)) {
            $response->setErrorMessage($jsonResult->errorMessage);
        }
        if (isset($jsonResult->errorGroup)) {
            $response->setErrorGroup($jsonResult->errorGroup);
        }
        if (isset($jsonResult->locale)) {
            $response->setLocale($jsonResult->locale);
        }
        if (isset($jsonResult->systemTime)) {
            $response->setSystemTime($jsonResult->systemTime);
        }
    }
}