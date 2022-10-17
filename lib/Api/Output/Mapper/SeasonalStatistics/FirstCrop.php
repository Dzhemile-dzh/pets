<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\SeasonalStatistics;

class FirstCrop extends \Api\Output\Mapper\HorsesMapper
{
    use \RP\Util\Math\GetPercent;
    use \Api\Row\Methods\SeasonalStatistics\GetOverallPrizeMoney;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'sire_uid' => 'sire_uid',
            '(fixAroHorseName)sire,sire_country_origin_code' => 'sire_style_name',
            'wins' => 'wins',
            'runs' => 'runs',
            'seconds' => 'second_place',
            'thirds' => 'third_place',
            'fourths' => 'fourth_place',
            '(roundNullable)win_prize_money_euro,2' => 'win_prize_money_euro',
            '(roundNullable)win_prize_money_pound,2' => 'win_prize_money',
            '(roundNullable)total_prize_money_euro,2' => 'total_prize_money_euro',
            '(roundNullable)total_prize_money_pound,2' => 'total_prize_money',
            '(getOverallPrizeMoney)win_prize_money_pound,win_prize_money_euro,rate_euro' => 'overall_win_prizemoney',
            '(getOverallPrizeMoney)total_prize_money_pound,total_prize_money_euro,rate_euro' => 'overall_total_prizemoney',
            '(roundNullable)net_win_prize_money,2' => 'net_win_prize_money',
            '(roundNullable)net_total_prize_money,2' => 'net_total_prize_money',
            'winners' => 'winners',
            'runners' => 'runners',
            'stakes_wins' => 'stakes_wins',
            'stakes_winner' => 'stakes_winner',
            'stakes_runner' => 'stakes_runner',
            '(getPercent)stakes_winner,stakes_runner' => 'stakes_winner_percent',
            'progeny_performers' => 'progeny_performers',
        ];
    }
}
