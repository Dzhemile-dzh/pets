<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 2/1/2016
 * Time: 3:08 PM
 */

namespace Api\Output\Mapper\Signposts;

class AheadOfHandicapper extends \Api\Output\Mapper\HorsesMapper
{
    protected function getMap()
    {
        return [
            '(fixAroHorseName)horse_style_name,horse_country_origin_code' => 'horse',
            'horse_uid' => 'horse_uid',
            'entries' => 'entries'
        ];
    }
}
