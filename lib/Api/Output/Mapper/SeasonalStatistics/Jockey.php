<?php

namespace Api\Output\Mapper\SeasonalStatistics;

use Api\Output\Mapper\HorsesMapper;

/**
 * @package Api\Output\Mapper\SeasonalStatistics
 */
class Jockey extends HorsesMapper
{
    use \Api\Row\Methods\SeasonalStatistics\GetOverallPrizeMoney;
    use \RP\Util\Math\GetPercent;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'jockey_uid' => 'jockey_uid',
            'jockey_style_name' => 'jockey_style_name',
            'surname' => 'jockey_surname',
            'aka_style_name' => 'jockey_short_name',
            '(dbYNFlagToBoolean)apprenctice_status' => 'apprenctice_status',
            '(dbYNFlagToBoolean)conditional_status' => 'conditional_status',
            'wins' => 'wins',
            'second_place' => 'second_place',
            'third_place' => 'third_place',
            'fourth_place' => 'fourth_place',
            'runs' => 'runs',
            '(roundNullable)winnings_pound,2' => 'winnings',
            '(roundNullable)earnings_pound,2' => 'earnings',
            '(roundNullable)winnings_euro,2' => 'winnings_euro',
            '(roundNullable)earnings_euro,2' => 'earnings_euro',
            '(getStake)' => 'stake',
            'favourite_runs' => 'favourite_runs',
            'favourite_wins' => 'favourite_wins',
            '(getPercent)favourite_wins,favourite_runs' => 'favourite_strikerate_percent',
        ];
    }
}
