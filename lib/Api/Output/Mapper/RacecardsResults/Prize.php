<?php

namespace Api\Output\Mapper\RacecardsResults;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * Class Prize
 * @package Api\Output\Mapper\RacecardsResults
 */
class Prize extends HorsesMapper
{
    use LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'position_no' => 'positionNo',
            '(roundToTwoDecimalPoints)prize_sterling' => 'GBP',
            '(roundToTwoDecimalPoints)prize_euro' => 'Euro',
        ];
    }
}