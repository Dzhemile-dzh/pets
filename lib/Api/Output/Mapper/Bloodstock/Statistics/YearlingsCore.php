<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 5/23/2016
 * Time: 10:50 AM
 */

namespace Api\Output\Mapper\Bloodstock\Statistics;

class YearlingsCore extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'sire_name' => 'sire_name',
            '(fixAroHorseName)style_name,country_origin_code' => 'sire_style_name',
            'sire_uid' => 'sire_uid',
            'colts' => 'colts',
            'fillies' => 'fillies',
        ];
    }
}
