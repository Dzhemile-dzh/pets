<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Results;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\XmlSupport\XmlSuppotTrait;
use Api\Output\Mapper\Methods\LegacyDecorators;
use Api\Constants\Horses as Constants;

/**
 * @package Api\Output\Mapper\Native\Results
 */
class Race extends HorsesMapper
{
    use XmlSuppotTrait;
    use LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            '(strval)"race"' => '(xmlHandler->asElementName)elName',
            'race_instance_uid' => '(xmlHandler->asAttribute)id',
            'card_details_available' => '(xmlHandler->asAttribute)card_details_available',
            'race_status_code' => '(xmlHandler->asAttribute)race_status_code',
            '(formatTime)race_datetime' => '(xmlHandler->asAttribute)time',
            '(getFastResult)race_status_code' => 'fastResult',
            'runners' => 'runners'
        ];
    }

    private function getFastResult($race_status_code)
    {
        $result = 0;

        if ($race_status_code === Constants::RACE_STATUS_OVERNIGHT_STR) {
            $result = 1;
        }

        return $result;
    }
}
