<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\SeasonalStatistics;

class Trainer extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Row\Methods\SeasonalStatistics\GetOverallPrizeMoney;
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'trainer_uid' => 'trainer_uid',
            'trainer_style_name' => 'trainer_style_name',
            'surname' => 'trainer_surname',
            'mirror_name' => 'trainer_short_name',
            'wins' => 'wins',
            'second_place' => 'second_place',
            'third_place' => 'third_place',
            'fourth_place' => 'fourth_place',
            'placed' => 'placed',
            'runs' => 'runs',
            '(roundNullable)winnings_pound,2' => 'winnings',
            '(roundNullable)earnings_pound,2' => 'earnings',
            '(roundNullable)winnings_euro,2' => 'winnings_euro',
            '(roundNullable)earnings_euro,2' => 'earnings_euro',
            '(getStake)' => 'stake',
            'class1to3Wins' => 'class1to3Wins',
            'class1to3Runs' => 'class1to3Runs',
            'class4to6Wins' => 'class4to6Wins',
            'class4to6Runs' => 'class4to6Runs',
            '(trim)country_code' => 'country_code',
            'winners' => 'winners',
            'runners' => 'runners',
            '(getPercent)winners,runners' => 'percent_winners_runners',
            'top_jockey' =>  'top_jockey'
        ];
    }
}
