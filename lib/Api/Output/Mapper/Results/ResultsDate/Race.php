<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\Results\ResultsDate;

class Race extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Row\Methods\GetDistanceInFurlong;

    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            'going_type_desc' => 'going_type_desc',
            'r_status' => 'race_status_code',
            '(dbYNFlagToBoolean)formbook_yn' => 'full_result_available',
            '(isWorldwideStakeRace)' => 'worldwide_stake',
            'has_details' => 'has_details',
            '(isScoop6Race)' => 'scoop6_race',
            'race_instance_title' => 'race_instance_title',
            'alt_race_title' => 'alt_race_title',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'race_type_code' => 'race_type_code',
            'r_dist' => 'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            'race_group_desc' => 'race_group_desc',
            'race_class' => 'race_class',
            'no_of_fences' => 'no_of_fences',
            'official_rating_band_desc' => 'official_rating_band_desc',
            'rp_ages_allowed_desc' => 'ages_allowed_desc',
            'straight_round_jubilee_code' => 'straight_round_jubilee_code',
            'straight_round_jubilee_desc' => 'straight_round_jubilee_desc',
            'rp_straight_round_jubilee_desc' => 'rp_straight_round_jubilee_desc',
            '(roundNullable)prize,2' => 'prize',

            'no_of_runners_calculated' => 'no_of_runners',
            '(stringToFloat)total_sp' => 'total_sp',
            'winner_time' => 'winner_time',
            'diff_to_standard_time_sec' => 'diff_to_standard_time_sec',
            '(nullIfStringEmpty)rp_analysis' => 'rp_analysis',

            'video_detail' => 'video_detail',
            'tote' => 'tote',
            'runners' => 'runners',
            'non_runners' => 'non_runners',
            'unplaced_favourites' => 'unplaced_favourites',
            'rule' => 'rule',
            'course_directions' => 'course_directions',
            'rp_omitted_fences' => 'rp_omitted_fences',
            'eyecatcher_horse_uid' => 'eyecatcher.horse_uid',
            '(fixAroHorseName)eyecatcher_style_name,eyecatcher_country_code' => 'eyecatcher.horse_name',
            'eyecatcher_notes' => 'eyecatcher.notes',
            'star_performer_horse_uid' => 'star_performer.horse_uid',
            '(fixAroHorseName)star_performer_style_name,star_performer_country_code' => 'star_performer.horse_name',
            'star_performer_notes' => 'star_performer.notes',
            'fast_race_instance_uid' => 'fast_race_instance_uid',
            'dividends' => 'dividends',
            'aw_surface_type' => 'aw_surface_type'
        ];
    }
}
