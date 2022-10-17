<?php

namespace Api\Output\Mapper\Bloodstock\Statistics;

/**
 * Class Rating
 *
 * @package Api\Output\Mapper\Bloodstock\Statistics
 */
class Rating extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)style_name,country_code' => 'horse_name',
            'horse_age' => 'horse_age',
            'horse_sex' => 'horse_sex',
            'country_code' => 'horse_country',
            'sire_uid' => 'sire_uid',
            '(fixAroHorseName)sire_style_name,sire_country_origin_code' => 'sire_name',
            'trainer_uid' => 'trainer_uid',
            'trainer_style_name' => 'trainer_name',
            'rpr' => 'best_rpr',
            'best_or' => 'best_or',
            'current_official_rating' => 'current_or',
            'wins' => 'wins',
            'runs' => 'runs',
            '(round)winnings_pound,2' => 'winnings',
            '(round)earnings_pound,2' => 'earnings',
            'winnings_euro' => 'winnings_euro',
            'earnings_euro' => 'earnings_euro',
            '(getStake)' => 'stake',
        ];
    }
}
