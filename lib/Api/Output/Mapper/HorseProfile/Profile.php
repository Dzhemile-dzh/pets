<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\HorseProfile;

use Api\Output\Mapper\Methods\CheckIfNotNullAndGreaterOrEqualToZero;
use Api\Row\Methods\GetWeatherBysApiIds;

/**
 * Class Profile
 *
 * @package Api\Output\Mapper\HorseProfile
 */
class Profile extends \Api\Output\Mapper\HorsesMapper
{
    use CheckIfNotNullAndGreaterOrEqualToZero;
    use GetWeatherBysApiIds;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)style_name,country_origin_code' => 'horse_name',
            'country_origin_code' => 'horse_country_origin_code',
            '(dateISO8601)horse_date_of_birth' => 'horse_date_of_birth',
            '(dateISO8601)horse_date_of_death' => 'horse_date_of_death',
            '(getHorseAge)' => 'age',
            '(dateISO8601)date_gelded' => 'date_gelded',
            'sire_uid' => 'sire_uid',
            'dam_uid' => 'dam_uid',
            '(fixAroHorseName)sire_horse_name,sire_country_origin_code' => 'sire_horse_name',
            'sire_country_origin_code' => 'sire_country_origin_code',
            '(fixAroHorseName)dam_horse_name,dam_country_origin_code' => 'dam_horse_name',
            'dam_country_origin_code' => 'dam_country_origin_code',
            '(fixAroHorseName)dam_sire_horse_name,dam_sire_country_origin_code' => 'dam_sire_horse_name',
            'dam_sire_country_origin_code' => 'dam_sire_country_origin_code',
            'sires_sire_uid' => 'sires_sire_uid',
            'sires_sire_name' => 'sires_sire_name',
            'owner_name' => 'owner_name',
            'owner_uid' => 'owner_uid',
            'owner_ptp_type_code' => 'owner_ptp_type_code',
            'trainer_name' => 'trainer_name',
            'trainer_uid' => 'trainer_uid',
            'trainer_location' => 'trainer_location',
            'trainer_ptp_type_code' => 'trainer_ptp_type_code',
            'breeder_name' => 'breeder_name',
            'horse_colour_code' => 'horse_colour_code',
            'horse_sex_code' => 'horse_sex_code',
            '(getSilkImagePath)' => 'silk_image_path',
            'tips' => 'tips',
            'comments' => 'comments',
            'trainer_last_14_days' => 'trainer_last_14_days',
            'previous_trainers' => 'previous_trainers',
            'previous_owners' => 'previous_owners',
            'dam_sire_uid' => 'dam_sire_uid',
            '(boolval)dam_status' => 'dam_status',
            '(boolval)sire_status' => 'sire_status',
            'horse_sex' => 'horse_sex',
            'horse_colour' => 'horse_colour',
            'sire_comment' => 'sire_comment',
            'avg_flat_win_dist' => 'avg_flat_win_dist',
            'sire_avg_flat_win_dist' => 'sire_avg_flat_win_dist',
            'dam_sire_avg_flat_win_dist' => 'dam_sire_avg_flat_win_dist',
            '(calculateAvgWinDistance)s_total_win_dist_of_progeny,s_total_no_of_wins' => 'avg_win_distance',
            '(calculateAvgWinDistance)shs_total_win_dist_of_progeny,shs_total_no_of_wins' => 'sire_avg_win_distance',
            '(calculateAvgWinDistance)shds_total_win_dist_of_progeny,shds_total_no_of_wins' => 'dam_sire_avg_win_distance',
            '(calculateAvgEarningsIndex)total_earnings_of_progeny,total_no_of_horses,total_earnings,total_runners' => 'avg_earnings_index',
            'stud_fee' => 'stud_fee',
            'weatherbys_uid' => 'weatherbys_uid',
            '(weatherBysIds)weatherbys_api_uid,weatherbys_uid' => 'weatherbys_api_uid',
            'to_follow' => 'to_follow',
            'owner_group_uid' => 'owner_group_uid',
        ];
    }

    private function calculateAvgWinDistance($total_win_dist_of_progeny, $total_no_of_wins)
    {
        $result = null;

        if ($this->checkIfNotNullAndGreaterOrEqualToZero($total_win_dist_of_progeny)
            && floatval($total_no_of_wins) > 0) {
            $result = floatval($total_win_dist_of_progeny) / $total_no_of_wins / 220;
        }

        return $result;
    }

    private function calculateAvgEarningsIndex($total_earnings_of_progeny, $total_no_of_horses, $total_earnings, $total_runners)
    {
        $result = null;

        if ($this->checkIfNotNullAndGreaterOrEqualToZero($total_earnings_of_progeny)
            && floatval($total_no_of_horses) > 0
            && floatval($total_earnings) > 0
            && floatval($total_runners) > 0
        ) {
            $result = ((float)$total_earnings_of_progeny / $total_no_of_horses) / ((float)$total_earnings / $total_runners);
        }

        return $result;
    }
}
