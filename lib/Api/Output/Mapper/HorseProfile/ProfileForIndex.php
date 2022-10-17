<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\HorseProfile;

/**
 * Class Profile
 *
 * @package Api\Output\Mapper\HorseProfile
 */
class ProfileForIndex extends \Api\Output\Mapper\HorsesMapper
{

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(fixAroHorseName)style_name,country_origin_code' => 'horse_name',
            'country_origin_code' => 'horse_country_code',
            '(dateISO8601)horse_date_of_birth' => 'horse_date_of_birth',
            '(dateISO8601)horse_date_of_death' => 'horse_date_of_death',
            '(getHorseAge)' => 'horse_age',
            '(dateISO8601)date_gelded' => 'date_gelded',
            'owner_name' => 'owner_name',
            'owner_uid' => 'owner_uid',
            'trainer_name' => 'trainer_name',
            'trainer_uid' => 'trainer_uid',
            'breeder_name' => 'breeder_name',
            'horse_colour_code' => 'horse_colour_code',
            'horse_sex_code' => 'horse_sex_code',
            '(getSilkImagePath)' => 'silk_image_path',
        ];
    }
}
