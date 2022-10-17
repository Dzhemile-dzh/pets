<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 10/6/14
 * Time: 3:29 PM
 */

namespace Api\Output\Mapper\SeasonalStatistics;

class Horse extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Row\Methods\SeasonalStatistics\GetOverallPrizeMoney;
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_style_name,country_code' => 'horse_style_name',
            'horse_age' => 'horse_age',
            'horse_sex_code' => 'horse_sex_code',
            'country_code' => 'country_code',
            'sire_uid' => 'sire_uid',
            '(fixAroHorseName)sire_style_name,sire_country_origin_code' => 'sire_style_name',
            'trainer_uid' => 'trainer_uid',
            'trainer_style_name' => 'trainer_style_name',
            'rpr' => 'rpr',
            'wins' => 'wins',
            'runs' => 'runs',
            '(roundNullable)winnings_pound,2' => 'winnings',
            '(roundNullable)earnings_pound,2' => 'earnings',
            '(roundNullable)winnings_euro,2' => 'winnings_euro',
            '(roundNullable)earnings_euro,2' => 'earnings_euro',
            '(roundNullable)net_total_prize,2' => 'net_total_prize',
            '(roundNullable)net_win_prize,2' => 'net_win_prize',
            '(getStake)' => 'stake',
        ];
    }
}
