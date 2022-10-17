<?php

namespace Api\Output\Mapper\Bloodstock\Stallion;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class DamSireProgenyHorses
 *
 * @package Api\Output\Mapper\Bloodstock\Stallion
 */
class DamSireProgenyHorses extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)style_name,country_origin_code' => 'horse_name',
            'country_origin_code' => 'country_origin_code',
            'horse_sex_code' => 'horse_sex_code',
            'horse_age' => 'horse_age',
            'runs' => 'runs',
            'wins' => 'wins',
            'places' => 'places',
            '(roundNullable)total_prize_money,2' => 'total_prize_money',
            'sire_uid' => 'sire_uid',
            'sire_style_name' => 'sire_style_name',
            'sire_country_origin_code' => 'sire_country_origin_code',
            'dam_sire_uid' => 'dam_sire_uid',
            'dam_sire_style_name' => 'dam_sire_style_name',
            'dam_sire_country_origin_code' => 'dam_sire_country_origin_code',
            'rp_postmark' => 'rp_postmark',
            '(getPercent)wins,runs' => 'win_percent',
            'best_or' => 'best_or'
        ];
    }
}
