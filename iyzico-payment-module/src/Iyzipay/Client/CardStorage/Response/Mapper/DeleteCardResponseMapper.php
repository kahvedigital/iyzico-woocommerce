<?php

namespace Iyzipay\Client\CardStorage\Response\Mapper;

use Iyzipay\Client\CardStorage\Response\DeleteCardResponse;
use Iyzipay\Client\ResponseMapper;

class DeleteCardResponseMapper extends ResponseMapper
{
    public static function newInstance()
    {
        return new DeleteCardResponseMapper();
    }

    public function mapResponse(DeleteCardResponse $response, $jsonResult)
    {
        parent::mapResponse($response, $jsonResult);
    }
}