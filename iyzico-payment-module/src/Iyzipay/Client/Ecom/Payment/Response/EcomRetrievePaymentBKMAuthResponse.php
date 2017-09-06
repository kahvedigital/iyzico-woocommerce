<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 11.11.2015
 * Time: 10:02
 */

namespace Iyzipay\Client\Ecom\Payment\Response;


use Iyzipay\Client\Ecom\Payment\Response\Mapper\EcomRetrievePaymentBKMAuthResponseMapper;

class EcomRetrievePaymentBKMAuthResponse extends EcomPaymentResponse
{
    public function fromJson($jsonResult)
    {
        EcomRetrievePaymentBKMAuthResponseMapper::newInstance()->mapResponse($this, $jsonResult);
    }

}