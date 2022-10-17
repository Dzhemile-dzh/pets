<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\SeasonalStatistics;

class Owner extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Row\Methods\SeasonalStatistics\GetOverallPrizeMoney;
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'owner_uid' => 'owner_uid',
            'owner_style_name' => 'owner_style_name',
            'wins' => 'wins',
            'second_place' => 'second_place',
            'third_place' => 'third_place',
            'fourth_place' => 'fourth_place',
            'runs' => 'runs',
            '(roundNullable)winnings_pound,2' => 'winnings',
            '(roundNullable)earnings_pound,2' => 'earnings',
            '(roundNullable)winnings_euro,2' => 'winnings_euro',
            '(roundNullable)earnings_euro,2' => 'earnings_euro',
            'winners' => 'winners',
            'runners' => 'runners',
            'placed' => 'placed',
            '(getStake)' => 'stake',
            '(getPercent)winners,runners' => 'percent_winners_runners',
            'top_trainer' =>  'top_trainer'
        ];
    }
}
