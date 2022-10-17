<?php

namespace Api\Output\Mapper\Bloodstock\Stallion;

/**
 * Class ProgenyStatisticsTop
 *
 * @package Api\Output\Mapper\Bloodstock\Stallion
 */
class ProgenyStatisticsTop extends \Api\Output\Mapper\HorsesMapper
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
            'dam_sire_uid' => 'dam_sire_uid',
            '(fixAroHorseName)dam_sire_style_name,dam_sire_country_origin_code' => 'dam_sire_style_name',
            'rp_postmark' => 'rp_postmark',
            'runs' => 'runs',
            'wins' => 'wins',
            '(getPercent)wins,runs' => 'wins_percent',
            '(round)total_prize_money,2' => 'total_prizemoney',
        ];
    }
}
