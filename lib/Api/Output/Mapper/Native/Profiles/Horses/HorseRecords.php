<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Profiles\Horses;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\XmlSupport\XmlSuppotTrait;
use \Api\Row\Methods\GetLifetimeName;
use \Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * @package Api\Output\Mapper\Native\Profiles\Horses
 */
class HorseRecords extends HorsesMapper
{
    use XmlSuppotTrait;
    use GetLifetimeName;
    use LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            '(strval)"record"' => '(xmlHandler->asElementName)elName',
            '(formatRaceType)race_type_code,"PTP"' => 'type',
            'race_count' => 'starts',
            'win' => 'wins',
            'second_places' => 'second_places',
            '(number_format)earnings' => 'earnings',
            '(zero2mdash)rpr' => 'rpr',
            '(zero2mdash)ts' => 'ts',
            '(zero2mdash)best_or' => 'or'
        ];
    }
}
