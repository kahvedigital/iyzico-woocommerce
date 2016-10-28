<?php

namespace Iyzipay\Client\Basic\Reporting\Response;

use Iyzipay\Client\Basic\Reporting\Response\Mapper\BouncedRowResponseMapper;
use Iyzipay\Client\Response;

class BouncedRowResponse extends Response
{
    private $bouncedRows;

    public function getBouncedRows()
    {
        return $this->bouncedRows;
    }

    public function setBouncedRows($bouncedRows)
    {
        $this->bouncedRows = $bouncedRows;
    }

    public function fromJson($jsonResult)
    {
        BouncedRowResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }
}