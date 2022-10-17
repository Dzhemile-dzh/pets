<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Results;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\XmlSupport\XmlSuppotTrait;

/**
 * @package Api\Output\Mapper\Native\Results
 */
class Date extends HorsesMapper
{
    use XmlSuppotTrait;

    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            '(strval)"date"' => '(xmlHandler->asElementName)date',
            'available' => '(xmlHandler->asAttribute)available',
            'dateValue' => '(xmlHandler->asElementValue)dateValue',
        ];
    }
}
