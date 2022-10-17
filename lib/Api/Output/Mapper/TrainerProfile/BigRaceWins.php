<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\TrainerProfile;

use \Api\Methods\CalculatePrizes;

class BigRaceWins extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;
    use \Api\Row\Methods\GetDistanceInFurlong;
    use CalculatePrizes;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(dateISO8601)race_date' => 'race_date',
            'country' => 'country',
            'course_uid' => 'course_uid',
            'course_name' => 'course_name',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            'course_type_code' => 'course_type_code',
            'days_diff' => 'days_diff',
            '(lowerIfNotNull)disqualification_desc' => 'disq_desc',
            'distance_yard' => 'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            '(fixAroHorseName)horse_style_name,country_origin_code' => 'horse_style_name',
            'horse_uid' => 'horse_uid',
            'jockey_style_name' => 'jockey_style_name',
            'jockey_short_name' => 'jockey_short_name',
            'jockey_uid' => 'jockey_uid',
            'jockey_ptp_type_code' => 'jockey_ptp_type_code',
            'video_detail' => 'video_detail',
            '(calculateSterlingPrize)country,prize_euro_gross,exchange_rate,prize_sterling' => 'prize_sterling',
            '(calculateEuroPrize)country,prize_euro_gross' => 'prize_euro',
            'race_group_code' => 'race_group_code',
            'race_group_desc' => 'race_group_desc',
            'race_instance_title' => 'race_instance_title',
            'race_instance_uid' => 'race_instance_uid',
            '(trim)race_outcome_code' => 'race_outcome_code',
            'race_outcome_position' => 'race_outcome_position',
            'race_type_code' => 'race_type_code',
            'rp_abbrev_3' => 'rp_abbrev_3',
        ];
    }

    /**
     * @param string|null $value
     * @return string|null
     */
    public function lowerIfNotNull(?string $value): ?string
    {
        return !is_null($value) ? strtolower($value) : $value;
    }
}
