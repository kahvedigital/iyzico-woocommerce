<?php

namespace Iyzipay\Client;

class PKIRequestStringBuilder
{
    private $requestString;

    function __construct($requestString)
    {
        $this->requestString = $requestString;
    }

    public static function newInstance()
    {
        return new PKIRequestStringBuilder("");
    }

    public static function fromRequestString($requestString)
    {
        return new PKIRequestStringBuilder($requestString);
    }

    /**
     * @param $superRequestString
     * @return PKIRequestStringBuilder
     */
    public function appendSuper($superRequestString)
    {
        if (isset($superRequestString)) {
            $superRequestString = substr($superRequestString, 1);
            $superRequestString = substr($superRequestString, 0, -1);

            if (strlen($superRequestString) > 0) {
                $this->requestString = $this->requestString . $superRequestString . ",";
            }
        }
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return PKIRequestStringBuilder
     */
    public function append($key, $value = null)
    {
        if (isset($value)) {
            if ($value instanceof PKIRequestStringConvertible) {
                $this->appendKeyValue($key, $value->toPKIRequestString());
            } else {
                $this->appendKeyValue($key, $value);
            }
        }
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return PKIRequestStringBuilder
     */
    public function appendPrice($key, $value = null)
    {
        if (isset($value)) {
            $this->appendKeyValue($key, RequestFormatter::formatPrice($value));
        }
        return $this;
    }

    /**
     * @param $key
     * @param array $array
     * @return PKIRequestStringBuilder
     */
    public function appendArray($key, array $array = null)
    {
        if (isset($array)) {
            $appendedValue = "";
            foreach ($array as $value) {
                if ($value instanceof PKIRequestStringConvertible) {
                    $appendedValue = $appendedValue . $value->toPKIRequestString();
                } else {
                    $appendedValue = $appendedValue . $value;
                }
                $appendedValue = $appendedValue . ", ";
            }
            $this->appendKeyValueArray($key, $appendedValue);
        }
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return PKIRequestStringBuilder
     */
    private function appendKeyValue($key, $value)
    {
        if (isset($value)) {
            $this->requestString = $this->requestString . $key . "=" . $value . ",";
        }
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return PKIRequestStringBuilder
     */
    private function appendKeyValueArray($key, $value)
    {
        if (isset($value)) {
            $value = substr($value, 0, -2);
            $this->requestString = $this->requestString . $key . "=[" . $value . "],";
        }
        return $this;
    }

    /**
     * @return PKIRequestStringBuilder
     */
    private function appendPrefix()
    {
        $this->requestString = "[" . $this->requestString . "]";
        return $this;
    }

    /**
     * @return PKIRequestStringBuilder
     */
    private function removeTrailingComma()
    {
        $this->requestString = substr($this->requestString, 0, -1);
        return $this;
    }

    public function getRequestString()
    {
        $this->removeTrailingComma();
        $this->appendPrefix();
        return $this->requestString;
    }
}