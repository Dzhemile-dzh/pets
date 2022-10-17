<?php
namespace Api\Output\Mapper\SeasonalStatistics;

class BroodmareSireProgenyPerformers extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_style_name,horse_country_origin_code' => 'horse_name',
            'sire_uid' => 'sire_uid',
            '(fixAroHorseName)sire_style_name,sire_country_origin_code' => 'sire_name',
            'rp_postmark' => 'rp_postmark',
        ];
    }
}
