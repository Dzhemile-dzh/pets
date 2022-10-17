<?php

namespace Api\Output\Mapper\Bloodstock\Stallion;

class ProgenyBroodmareSiresStatisticsTop extends \Api\Output\Mapper\HorsesMapper
{
    use \RP\Util\Math\GetPercent;
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_style_name,horse_country_origin_code' => 'horse_style_name',
            'sire_uid' => 'sire_uid',
            '(fixAroHorseName)sire_style_name,sire_country_origin_code' => 'sire_style_name',
            'rp_postmark' => 'rp_postmark',
            'runs' => 'runs',
            'wins' => 'wins',
            '(getPercent)wins,runs' => 'wins_percent',
            '(roundNullable)total_prize_money,2' => 'total_prizemoney',
        ];
    }
}
