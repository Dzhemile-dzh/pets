<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\HorseProfile;

class PedigreeShort extends \Api\Output\Mapper\HorsesMapper
{

    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)style_name,country_origin_code' => 'horse_name',
            'country_origin_code' => 'country_origin_code',
            '(dateISO8601)horse_date_of_birth' => 'horse_date_of_birth',
            'sire_uid' => 'sire_uid',
            'dam_uid' => 'dam_uid',
            'avg_flat_win_dist_of_progeny' => 'avg_flat_win_dist_of_progeny',
            'horse_colour_code' => 'horse_colour_code',
            'horse_sex_code' => 'horse_sex_code',
            'rp_form_text' => 'rp_form_text',
        ];
    }
}
