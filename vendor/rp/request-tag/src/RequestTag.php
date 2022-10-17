<?php

namespace RP;

/**
 * Class RequestTag
 * @package RP
 */
class RequestTag
{

    const MARKER_HEADER_NAME_DEFAULT = 'X-RP-Request-Id';
    const MARKER_DEFAULT = '-';

    private $key = RequestTag::MARKER_HEADER_NAME_DEFAULT;

    /**
     * @var string
     */
    private $value = RequestTag::MARKER_DEFAULT;

    /**
     * RequestTag constructor.
     * @param string $requestTagName
     */
    public function __construct($requestTagName = RequestTag::MARKER_HEADER_NAME_DEFAULT)
    {
        $this->key = $requestTagName;
        $headers = $this->getHeaders();
        if (array_key_exists($this->key, $headers)) {
            $this->value = $headers[$this->key];
        }
    }

    /**
     * @return array|false
     */
    protected function getHeaders()
    {
        return getallheaders();
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}