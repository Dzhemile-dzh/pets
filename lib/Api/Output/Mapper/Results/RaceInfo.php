<?php

namespace Api\Output\Mapper\Results;

/**
 * Class RaceInfo
 *
 * @package Api\Output\Mapper\Results
 */
class RaceInfo extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;
    use \Api\Row\Methods\GetDistanceInFurlong;
    use \Api\Output\Mapper\Methods\LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_status_code' => 'race_status_code',
            '(dateISO8601)race_datetime' => 'race_datetime',
            '(dateISO8601)race_start_datetime' => 'race_start_datetime',
            '(localDateISO8601)race_datetime,hours_difference' => 'local_meeting_race_datetime',
            'race_instance_title' => 'race_instance_title',
            'race_type_code' => 'race_type_code',
            'race_surface' => 'race_surface',
            'distance_yard' => 'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            'race_group_desc' => 'race_group_desc',
            'race_class' => 'race_class',
            'no_of_fences' => 'no_of_fences',
            'rp_ages_allowed_desc' => 'ages_allowed_desc',
            '(trimAndNullifyString)official_rating_band_desc' => 'official_rating_band_desc',
            'straight_round_jubilee_code' => 'straight_round_jubilee_code',
            'straight_round_jubilee_desc' => 'straight_round_jubilee_desc',
            'rp_straight_round_jubilee_desc' => 'rp_straight_round_jubilee_desc',
            'course_uid' => 'course_uid',
            'course_name' => 'course_name',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(stringToURLkey)course_name' => 'course_key',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(trimAndNullifyString)country_code' => 'course_country_code',
            'country_desc' => 'course_country_desc',
            '(getCourseContinent)country_code' => 'course_region',
            'meeting_name' => 'meeting_name',
            '(dateISO8601)meeting_date' => 'meeting_date',
            'meeting_abandoned' => 'meeting_abandoned',
            'abandoned_reason' => 'abandoned_reason',
            'going_desc' => 'meeting_going_desc',
            'going_type_code' => 'going_type_code',
            'going_type_desc' => 'going_type_desc',
            'race_comments' => 'race_comments',
            'rp_omitted_fences' => 'omitted_fences',
            '(dbYNFlagToBoolean)start_flag_yn' => 'start_flag',
            'stalls_position' => 'stalls_position',
            'misc_text' => 'misc_text',
            'rails' => 'rails',
            '(nullIfStringEmpty)wind' => 'wind',
            '(nullIfStringEmpty)rp_analysis' => 'rp_analysis',
            'prizes' => 'prizes',
            'eyecatcher_horse_uid' => 'eyecatcher.horse_uid',
            '(fixAroHorseName)eyecatcher_style_name,eyecatcher_country_code' => 'eyecatcher.horse_name',
            'eyecatcher_notes' => 'eyecatcher.notes',
            'star_performer_horse_uid' => 'star_performer.horse_uid',
            '(fixAroHorseName)star_performer_style_name,star_performer_country_code' => 'star_performer.horse_name',
            'star_performer_notes' => 'star_performer.notes',
            '(fixEuroSymbol)tote_deadheat_text' => 'tote.tote_deadheat_text',
            'tote_win_money' => 'tote.tote_win_money',
            'tote_place_1_money' => 'tote.tote_place_1_Money',
            'tote_place_2_money' => 'tote.tote_place_2_Money',
            'tote_place_3_money' => 'tote.tote_place_3_Money',
            'tote_place_4_money' => 'tote.tote_place_4_Money',
            'tote_dual_forecast_money' => 'tote.tote_dual_forecast_money',
            'computer_strght_frcst_money' => 'tote.computer_strght_frcst_money',
            'tricast_money' => 'tote.tricast_money',
            'tote_trio_money' => 'tote.tote_trio_money',
            'trio_text' => 'tote.trio_text',
            'rule4_text' => 'tote.rule_4_Text',
            'selling_details_text' => 'tote.selling_details_text',
            '(fixEuroSymbol)jackpot_text' => 'tote.jackpot_text',
            '(fixEuroSymbol)placepot_text' => 'tote.placepot_text',
            '(fixEuroSymbol)quadpot_text' => 'tote.quadpot_text',
            'dividends' => 'dividends',
            'video_detail' => 'video_detail',
            'aw_surface_type' => 'aw_surface_type'
        ];
    }
}
