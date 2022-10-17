<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Cards\NextRace;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\XmlSupport\XmlSuppotTrait;

/**
 * @package Api\Output\Mapper\Native\Cards\NextRace
 */
class Id extends HorsesMapper
{
    use XmlSuppotTrait;

    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            '(strval)"nextRaceId"' => '(xmlHandler->asElementName)root',
            //due to native logic: /php_includes/xml/controllers/class_cards_list_controller.inc: 186
            '(intval)"1"' => '(xmlHandler->asAttribute)details_available',
            'race_instance_uid' => '(xmlHandler->asElementValue)nextRaceId',

        ];
    }
}
