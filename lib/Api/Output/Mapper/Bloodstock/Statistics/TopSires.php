<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 5/13/2016
 * Time: 2:28 PM
 */

namespace Api\Output\Mapper\Bloodstock\Statistics;

class TopSires extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'sire_uid' => 'sire_uid',
            '(fixAroHorseName)sire_name,sire_country_origin_code' => 'sire_name',
            'runners' => 'runners',
            'best_horse_uid' => 'best_horse_uid',
            '(fixAroHorseName)best_horse_name,best_horse_country_origin_code' => 'best_horse_name',
            'best_rp_postmark' => 'best_rp_postmark',
            'rated_80_plus' => 'rated_80_plus',
            'rated_100_plus' => 'rated_100_plus',
            'rated_115_plus' => 'rated_115_plus',
            'percent_rated_80_plus' => 'percent_rated_80_plus',
            'percent_rated_100_plus' => 'percent_rated_100_plus',
            'percent_rated_115_plus' => 'percent_rated_115_plus',
        ];
    }
}
