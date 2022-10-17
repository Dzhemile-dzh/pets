<?php

namespace Api\Output\XmlSupport;

/**
 * @package Api\Output\XmlSupport
 */
class XmlHandler
{
    /**
     * @param $value
     */
    public function asAttribute(&$value): void
    {
        $value = new XmlProperty($value);
        $value->isAttribute = true;
    }

    /**
     * @param $value
     */
    public function asElementName(&$value): void
    {
        $value = new XmlProperty($value);
        $value->isElementName = true;
    }

    /**
     * @param $value
     */
    public function asElementValue(&$value): void
    {
        $value = new XmlProperty($value);
        $value->isElementValue = true;
    }
}
