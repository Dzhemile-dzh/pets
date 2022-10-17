<?php
namespace Api\Output\Mapper\SeasonalStatistics;

class BroodmareSire extends \Api\Output\Mapper\HorsesMapper
{
    use \RP\Util\Math\GetPercent;
    use \Api\Row\Methods\SeasonalStatistics\GetOverallPrizeMoney;
    use \Api\Row\Methods\GetWeatherBysApiIds;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'dam_sire_uid' => 'dam_sire_uid',
            '(fixAroHorseName)dam_sire,dam_sire_country_origin_code' => 'dam_sire_style_name',
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
