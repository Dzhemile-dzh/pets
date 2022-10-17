<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Cards\BigRaces;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\XmlSupport\XmlSuppotTrait;

/**
 * @package Api\Output\Mapper\Native\Cards
 */
class Race extends HorsesMapper
{
    use XmlSuppotTrait;
    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            '(strval)"race"' => '(xmlHandler->asElementName)elName',
            'race_id' => '(xmlHandler->asAttribute)id',
            'race_title' => 'title',
            'date' => 'date',
            'time' => 'time',
            'ampm' => 'ampm',
            'meeting' => 'meeting',
            '(strval)"1"' => 'bettingLink',
        ];
    }
}
