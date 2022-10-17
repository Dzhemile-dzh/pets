<?php

namespace Api\Output\XmlSupport;

/**
 * @package Api\Output\XmlSupport
 */
class XmlProperty
{
    public $isAttribute = false;
    public $isElementName = false;
    public $isElementValue = false;
    public $value = null;

    /**
     * XmlProperty constructor.
     *
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }
}
