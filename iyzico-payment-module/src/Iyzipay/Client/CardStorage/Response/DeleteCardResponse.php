<?php

namespace Iyzipay\Client\CardStorage\Response;

use Iyzipay\Client\CardStorage\Response\Mapper\DeleteCardResponseMapper;
use Iyzipay\Client\Response;

class DeleteCardResponse extends Response
{
    public function fromJson($jsonResult)
    {
        DeleteCardResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}