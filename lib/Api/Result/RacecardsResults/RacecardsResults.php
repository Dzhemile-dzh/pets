<?php

namespace Api\Result\RacecardsResults;

use Api\Result\Json as Result;

/**
 * Class RacecardsResults
 * @package Api\Result\RacecardsResults
 */
class RacecardsResults extends Result
{
    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'race' => 'Api\Output\Mapper\RacecardsResults\RaceInfo',
            'race.replayDetails' => 'Api\Output\Mapper\RacecardsResults\ReplayDetails',
            'race.bettingReturns' => 'Api\Output\Mapper\RacecardsResults\BettingReturns',
            'race.prize' => 'Api\Output\Mapper\RacecardsResults\Prize',
            'race.runners' => 'Api\Output\Mapper\RacecardsResults\Runners',
            'race.runners.position' => 'Api\Output\Mapper\RacecardsResults\Position',
            'race.runners.tippedBy' => 'Api\Output\Mapper\RacecardsResults\Tips',
            'race.runners.premiumTips' => 'Api\Output\Mapper\RacecardsResults\Tips',
            'race.runners.formFigures' => 'Api\Output\Mapper\RacecardsResults\FormFigures',
        ];
    }
}
