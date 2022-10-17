<?php
namespace Api\Output\Mapper\SeasonalStatistics;

use Api\Output\Mapper\HorsesMapper;
use Api\Row\Methods\GetWeatherBysApiIds;
use Api\Row\Methods\SeasonalStatistics\GetOverallPrizeMoney;
use RP\Util\Math\GetPercent;

class Sire extends HorsesMapper
{
    use GetPercent;
    use GetOverallPrizeMoney;
    use GetWeatherBysApiIds;

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
            'weatherbys_uid' => 'weatherbys_uid',
            '(weatherBysIds)weatherbys_api_uid,weatherbys_uid' => 'weatherbys_api_uid',
            'stakes_wins' => 'stakes_wins',
            'stakes_winner' => 'stakes_winner',
            'stakes_runner' => 'stakes_runner',
            '(getPercent)stakes_winner,stakes_runner' => 'stakes_winner_percent',
            'progeny_performers' => 'progeny_performers',
        ];
    }
}
