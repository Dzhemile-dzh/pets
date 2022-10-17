<?php

namespace Api\Output\XmlSupport;

use Phalcon\Output\ResultClearbleInterface;

/**
 * @package Api\Output\XmlSupport
 */
trait ConvertXmlProperties
{
    /**
     * @param $data
     */
    public function clearData(&$data)
    {
        foreach ($data as $k => &$value) {
            if ($value instanceof XmlProperty) {
                $value = $value->value;
            } elseif (is_array($value) || is_object($value)) {
                $this->clearData($value);
            }
        }
    }
}
