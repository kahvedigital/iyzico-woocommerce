<?php

namespace Iyzipay\Client;

class Response implements FromJson
{
    private $rawResult;
    private $status;
    private $errorCode;
    private $errorMessage;
    private $errorGroup;
    private $locale;
    private $systemTime;
    private $conversationId;

    public function getRawResult()
    {
        return $this->rawResult;
    }

    public function setRawResult($rawResult)
    {
        $this->rawResult = $rawResult;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }

    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    public function getErrorGroup()
    {
        return $this->errorGroup;
    }

    public function setErrorGroup($errorGroup)
    {
        $this->errorGroup = $errorGroup;
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    public function getSystemTime()
    {
        return $this->systemTime;
    }

    public function setSystemTime($systemTime)
    {
        $this->systemTime = $systemTime;
    }

    public function getConversationId()
    {
        return $this->conversationId;
    }

    public function setConversationId($conversationId)
    {
        $this->conversationId = $conversationId;
    }

    public function fromJson($jsonResult)
    {
        ResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}