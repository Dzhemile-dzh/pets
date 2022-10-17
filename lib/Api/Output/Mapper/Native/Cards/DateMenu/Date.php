<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Cards\DateMenu;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\XmlSupport\XmlSuppotTrait;

/**
 * @package Api\Output\Mapper\Native\Cards\DateMenu
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
            '(strval)"date"' => '(xmlHandler->asElementName)elName',
            'available' => '(xmlHandler->asAttribute)available',
            'date' => '(xmlHandler->asElementValue)date',
        ];
    }
}
