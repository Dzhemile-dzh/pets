<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Meetings\MeetingsFieldMeetingType;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * This test aims to cover the implementation from :
 *      https://racingpost.atlassian.net/browse/AD-1665
 *
 * The following scenarios should be covered:
 *      Scenario 1: Meeting with only flat/jumps races
 *      Scenario 2: Meeting with both flat and jumps races
 *      Scenario 3: Meeting with only point-to-point races
 *
 * Class Test
 *
 * @package Tests\Controllers\Horses\Meetings
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/meetings?date=2020-12-01';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\Meetings\:22 ->getMeetingsData()
            '694048db09c53ad53ac5eb47b4968390' => [
                // 0 / 1 is Scenario 1 only jumps
                0 => [
                    'meetingId' => null,
                    'rp_meeting_order' => null,
                    'race_instance_title' => 'Iron Stand Conditional Jockeys\' Handicap Hurdle',
                    'race_instance_uid' => 778611,
                    'early_closing_race_yn' => null,
                    'race_datetime' => '2021-03-28 13:00:00',
                    'race_group_uid' => 6,
                    'race_group_desc' => 'Handicap',
                    'race_type_code' => 'H',
                    'weather_details' => null,
                    'going_desc' => 'Good',
                    'sumNonRunners' => 0,
                    'distance_yard' => 4761,
                    'race_status_code' => 'C',
                    'pool_prize_sterling' => 10900,
                    'fast_race_instance_uid' => null,
                    'course_uid' => 2,
                    'style_name' => 'Ascot',
                    'course_name' => 'ASCOT',
                    'country_code' => 'GB ',
                    'course_type_code' => 'B',
                    'mixed_course_uid' => null,
                    'hours_difference' => null,
                    'no_of_runners' => null,
                    'jackpot_text' => null,
                    'placepot_text' => null,
                    'quadpot_text' => null,
                    'tote_win_money' => null,
                    'tote_place_1_money' => null,
                    'tote_place_2_money' => null,
                    'tote_place_3_money' => null,
                    'tote_place_4_money' => null,
                    'computer_strght_frcst_money' => null,
                    'tricast_money' => null,
                    'tote_trio_money' => null,
                    'rule4_value' => null,
                    'rule4_text' => null,
                    'rp_ages_allowed_desc' => '4yo+',
                    'official_rating_band_desc' => '0-140',
                    'going_type_desc' => null,
                    'rp_tv_text' => 'SKY',
                    'perform_race_uid_atr' => null,
                    'perform_race_uid_ruk' => null,
                    'surface' => null,
                    'race_class' => '3',
                ],
                1 => [
                    'meetingId' => null,
                    'rp_meeting_order' => null,
                    'race_instance_title' => 'Ascot Maiden Hurdle (Gbb Race)',
                    'race_instance_uid' => 778612,
                    'early_closing_race_yn' => null,
                    'race_datetime' => '2021-03-28 13:35:00',
                    'race_group_uid' => 0,
                    'race_group_desc' => null,
                    'race_type_code' => 'H',
                    'weather_details' => null,
                    'sumNonRunners' => 0,
                    'going_desc' => 'Good',
                    'distance_yard' => 4238,
                    'race_status_code' => 'C',
                    'pool_prize_sterling' => 6000,
                    'fast_race_instance_uid' => null,
                    'course_uid' => 2,
                    'style_name' => 'Ascot',
                    'course_name' => 'ASCOT',
                    'country_code' => 'GB ',
                    'course_type_code' => 'B',
                    'mixed_course_uid' => null,
                    'hours_difference' => null,
                    'no_of_runners' => null,
                    'jackpot_text' => null,
                    'placepot_text' => null,
                    'quadpot_text' => null,
                    'tote_win_money' => null,
                    'tote_place_1_money' => null,
                    'tote_place_2_money' => null,
                    'tote_place_3_money' => null,
                    'tote_place_4_money' => null,
                    'computer_strght_frcst_money' => null,
                    'tricast_money' => null,
                    'tote_trio_money' => null,
                    'rule4_value' => null,
                    'rule4_text' => null,
                    'rp_ages_allowed_desc' => '4yo+',
                    'official_rating_band_desc' => null,
                    'going_type_desc' => null,
                    'rp_tv_text' => 'SKY',
                    'perform_race_uid_atr' => null,
                    'perform_race_uid_ruk' => null,
                    'surface' => null,
                    'race_class' => '4',
                ],
                // 2 / 3 is Scenario 1 only flat
                2 => [
                    'meetingId' => null,
                    'rp_meeting_order' => null,
                    'race_instance_title' => 'Iron Stand Conditional Jockeys\' Handicap Hurdle',
                    'race_instance_uid' => 778612,
                    'early_closing_race_yn' => null,
                    'race_datetime' => '2021-03-28 13:00:00',
                    'race_group_uid' => 6,
                    'race_group_desc' => 'Handicap',
                    'race_type_code' => 'F',
                    'weather_details' => null,
                    'going_desc' => 'Good',
                    'sumNonRunners' => 0,
                    'distance_yard' => 4761,
                    'race_status_code' => 'C',
                    'pool_prize_sterling' => 10900,
                    'fast_race_instance_uid' => null,
                    'course_uid' => 3,
                    'style_name' => 'Ascot',
                    'course_name' => 'ASCOT',
                    'country_code' => 'GB ',
                    'course_type_code' => 'B',
                    'mixed_course_uid' => null,
                    'hours_difference' => null,
                    'no_of_runners' => null,
                    'jackpot_text' => null,
                    'placepot_text' => null,
                    'quadpot_text' => null,
                    'tote_win_money' => null,
                    'tote_place_1_money' => null,
                    'tote_place_2_money' => null,
                    'tote_place_3_money' => null,
                    'tote_place_4_money' => null,
                    'computer_strght_frcst_money' => null,
                    'tricast_money' => null,
                    'tote_trio_money' => null,
                    'rule4_value' => null,
                    'rule4_text' => null,
                    'rp_ages_allowed_desc' => '4yo+',
                    'official_rating_band_desc' => '0-140',
                    'going_type_desc' => null,
                    'rp_tv_text' => 'SKY',
                    'perform_race_uid_atr' => null,
                    'perform_race_uid_ruk' => null,
                    'surface' => null,
                    'race_class' => '3',
                ],
                3=> [
                    'meetingId' => null,
                    'rp_meeting_order' => null,
                    'race_instance_title' => 'Ascot Maiden Hurdle (Gbb Race)',
                    'race_instance_uid' => 778613,
                    'early_closing_race_yn' => null,
                    'race_datetime' => '2021-03-28 13:35:00',
                    'race_group_uid' => 0,
                    'race_group_desc' => null,
                    'race_type_code' => 'F',
                    'distance_yard' => 4238,
                    'race_status_code' => 'C',
                    'weather_details' => null,
                    'going_desc' => 'Good',
                    'sumNonRunners' => 0,
                    'pool_prize_sterling' => 6000,
                    'fast_race_instance_uid' => null,
                    'course_uid' => 3,
                    'style_name' => 'Ascot',
                    'course_name' => 'ASCOT',
                    'country_code' => 'GB ',
                    'course_type_code' => 'B',
                    'mixed_course_uid' => null,
                    'hours_difference' => null,
                    'no_of_runners' => null,
                    'jackpot_text' => null,
                    'placepot_text' => null,
                    'quadpot_text' => null,
                    'tote_win_money' => null,
                    'tote_place_1_money' => null,
                    'tote_place_2_money' => null,
                    'tote_place_3_money' => null,
                    'tote_place_4_money' => null,
                    'computer_strght_frcst_money' => null,
                    'tricast_money' => null,
                    'tote_trio_money' => null,
                    'rule4_value' => null,
                    'rule4_text' => null,
                    'rp_ages_allowed_desc' => '4yo+',
                    'official_rating_band_desc' => null,
                    'going_type_desc' => null,
                    'rp_tv_text' => 'SKY',
                    'perform_race_uid_atr' => null,
                    'perform_race_uid_ruk' => null,
                    'surface' => null,
                    'race_class' => '4',
                ],
                // 4 / 5 is Scenario 2 - mixed - both jumps / flat
                4 => [
                    'meetingId' => null,
                    'rp_meeting_order' => null,
                    'race_instance_title' => 'Iron Stand Conditional Jockeys\' Handicap Hurdle',
                    'race_instance_uid' => 778614,
                    'early_closing_race_yn' => null,
                    'race_datetime' => '2021-03-28 13:00:00',
                    'race_group_uid' => 6,
                    'race_group_desc' => 'Handicap',
                    'race_type_code' => 'F',
                    'weather_details' => null,
                    'going_desc' => 'Good',
                    'sumNonRunners' => 0,
                    'distance_yard' => 4761,
                    'race_status_code' => 'C',
                    'pool_prize_sterling' => 10900,
                    'fast_race_instance_uid' => null,
                    'course_uid' => 4,
                    'style_name' => 'Ascot',
                    'course_name' => 'ASCOT',
                    'country_code' => 'GB ',
                    'course_type_code' => 'B',
                    'mixed_course_uid' => null,
                    'hours_difference' => null,
                    'no_of_runners' => null,
                    'jackpot_text' => null,
                    'placepot_text' => null,
                    'quadpot_text' => null,
                    'tote_win_money' => null,
                    'tote_place_1_money' => null,
                    'tote_place_2_money' => null,
                    'tote_place_3_money' => null,
                    'tote_place_4_money' => null,
                    'computer_strght_frcst_money' => null,
                    'tricast_money' => null,
                    'tote_trio_money' => null,
                    'rule4_value' => null,
                    'rule4_text' => null,
                    'rp_ages_allowed_desc' => '4yo+',
                    'official_rating_band_desc' => '0-140',
                    'going_type_desc' => null,
                    'rp_tv_text' => 'SKY',
                    'perform_race_uid_atr' => null,
                    'perform_race_uid_ruk' => null,
                    'surface' => null,
                    'race_class' => '3',
                ],
                5=> [
                    'meetingId' => null,
                    'rp_meeting_order' => null,
                    'race_instance_title' => 'Ascot Maiden Hurdle (Gbb Race)',
                    'race_instance_uid' => 778615,
                    'early_closing_race_yn' => null,
                    'race_datetime' => '2021-03-28 13:35:00',
                    'race_group_uid' => 0,
                    'race_group_desc' => null,
                    'race_type_code' => 'H',
                    'weather_details' => null,
                    'going_desc' => 'Good',
                    'sumNonRunners' => 0,
                    'distance_yard' => 4238,
                    'race_status_code' => 'C',
                    'pool_prize_sterling' => 6000,
                    'fast_race_instance_uid' => null,
                    'course_uid' => 4,
                    'style_name' => 'Ascot',
                    'course_name' => 'ASCOT',
                    'country_code' => 'GB ',
                    'course_type_code' => 'B',
                    'mixed_course_uid' => null,
                    'hours_difference' => null,
                    'no_of_runners' => null,
                    'jackpot_text' => null,
                    'placepot_text' => null,
                    'quadpot_text' => null,
                    'tote_win_money' => null,
                    'tote_place_1_money' => null,
                    'tote_place_2_money' => null,
                    'tote_place_3_money' => null,
                    'tote_place_4_money' => null,
                    'computer_strght_frcst_money' => null,
                    'tricast_money' => null,
                    'tote_trio_money' => null,
                    'rule4_value' => null,
                    'rule4_text' => null,
                    'rp_ages_allowed_desc' => '4yo+',
                    'official_rating_band_desc' => null,
                    'going_type_desc' => null,
                    'rp_tv_text' => 'SKY',
                    'perform_race_uid_atr' => null,
                    'perform_race_uid_ruk' => null,
                    'surface' => null,
                    'race_class' => '4',
                ]
            ],
            //Models\Bo\Results\RaceAttribLookup\:56 ->getRaceCategory()
            '0d822f1c1520b5e0a5d927db19a72f8b' => [
            ],
            //Models\Bo\Results\RaceAttribLookup\:56 ->getRaceCategory()
            '431ee7dfd4b69401e6a207da4c8cdde5' => [
            ],
            //Models\Bo\Results\RaceAttribLookup\:56 ->getRaceCategory()
            '715a0fc8458c69f87da812d197379848' => [
            ],
            //Models\Bo\Results\RaceAttribLookup\:56 ->getRaceCategory()
            'ee6c714ccc0005599d1e355e05529b84' => [
            ],
            //Models\Bo\Results\RaceAttribLookup\:56 ->getRaceCategory()
            '3bd55cc4205bdbde66ae43c410332336' => [
            ],
            //Models\Bo\Results\RaceAttribLookup\:56 ->getRaceCategory()
            '4a1b7a8d59c6af3acee78410361819ef' => [
                [
                    'race_attrib_desc' => 'Nov'
                ]
            ],
            //Models\Bo\Results\RaceAttribLookup\:56 ->getRaceCategory()
            'b1c41a84e0e8609b6751ea3d3f27bbd7' => [
                [
                    'race_attrib_desc' => 'Nov'
                ]
            ]
        ];
    }
}
