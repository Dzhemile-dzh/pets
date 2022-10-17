<?php
namespace Api\Output\Mapper\SeasonalStatistics;

class SireProgenyPerformers extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_style_name,horse_country_origin_code' => 'horse_name',
            'dam_sire_uid' => 'dam_sire_uid',
            '(fixAroHorseName)dam_sire_style_name,dam_sire_country_origin_code' => 'dam_sire_name',
            'rp_postmark' => 'rp_postmark',
        ];
    }
}
