<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Competitor;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\XmlSupport\XmlSuppotTrait;
use \Api\Row\Methods\GetLifetimeName;

/**
 * @package Api\Output\Mapper\Native\Competitor
 */
class CompetitorRaceRecord extends HorsesMapper
{
    use XmlSuppotTrait;
    use GetLifetimeName;

    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            '(trim)"record"' => '(xmlHandler->asElementName)record',
            '(getLifetimeNameForLineType)race_type_code' => 'lifetimeName',
            'race_count' => 'starts',
            'win' => 'wins',
            '(thousandsCurrencyFormat)earnings' => 'winPrize',
            '(zero2mdash)ts' => 'bestTs',
            '(zero2mdash)rpr' => 'bestRpr',
            '(zero2mdash)best_or' => 'latestBhb',
        ];
    }
}
