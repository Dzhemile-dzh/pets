<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Cards\NextRace;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\XmlSupport\XmlSuppotTrait;

/**
 * @package Api\Output\Mapper\Native\Cards\NextRace
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
            '(strval)"nextRaceDate"' => '(xmlHandler->asElementName)elementName',
            '(toDate)race_datetime' => '(xmlHandler->asElementValue)race_datetime',
        ];
    }

    public function toDate(string $date): string
    {
        $timestamp = strtotime($date);
        return date("Y-m-d", $timestamp);
    }
}
