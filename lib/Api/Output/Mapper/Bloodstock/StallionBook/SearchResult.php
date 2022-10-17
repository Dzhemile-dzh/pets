<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 3/29/2016
 * Time: 12:47 PM
 */

namespace Api\Output\Mapper\Bloodstock\StallionBook;

use Api\Output\Mapper\HorsesMapper;
use Api\Row\Methods\GetWeatherBysApiIds;

class SearchResult extends HorsesMapper
{

    use GetWeatherBysApiIds;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)style_name,country_origin_code' => 'style_name',
            'country_origin_code' => 'country_origin_code',
            'sire_uid' => 'sire_uid',
            '(fixAroHorseName)sire_style_name,sire_country_origin_code' => 'sire_style_name',
            'sire_line_uid' => 'sire_line_uid',
            '(fixAroHorseName)sire_line_style_name,sire_line_country_origin_code' => 'sire_line_style_name',
            'stud_name' => 'stud_name',
            'stud_country_code' => 'stud_country_code',
            'stud_fee' => 'stud_fee',
            'stud_fee_condition' => 'stud_fee_condition',
            'year_to_stud' => 'year_to_stud',
            'fee_cur_code' => 'fee_cur_code',
            'exchange_rate' => 'exchange_rate',
            'weatherbys_uid' => 'weatherbys_uid',
            '(weatherBysIds)weatherbys_api_uid,weatherbys_uid' => 'weatherbys_api_uid',
            'private_flag' => 'private_flag',
        ];
    }
}
