<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Meetings;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * This test aims to cover the implementation from :
 *      https://racingpost.atlassian.net/browse/AD-1517
 *      https://racingpost.atlassian.net/browse/AD-1551
 *      https://racingpost.atlassian.net/browse/AD-1542
 *      https://racingpost.atlassian.net/browse/AD-1555
 *
 * The following scenarios should be covered:
 *      Scenario 1: isHandicap field is true when race_group_uid in (5,6,11,12,13,14,15,16)
 *      Scenario 2: mixed_course_uid is populated when we are at course_uid (28, 31, 37, 61)
 *      Scenario 3: diffusionName is correctly mapped
 *      Scenario 4: early closer raceStatusCode
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
        return '/horses/meetings?date=2030-01-01';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\Meetings\:22 ->getMeetingsData()
            'c17077ecdc6dd14f18c201fc0e050b3c' => [
                [
                    'meetingId' => null,
                    'rp_meeting_order' => null,
                    'style_name' => 'LINGFIELD (A.W)',
                    'course_name' => 'Lingfield (A.W)',
                    'course_uid' => 375,
                    'early_closing_race_yn' => null,
                    'mixed_course_uid' => null,
                    'fast_race_instance_uid' => null,
                    'country_code' => 'USA',
                    'course_type_code' => 'B',
                    'numberOfRaces' => 1,
                    'sumNonRunners' => 0,
                    'race_status_code' => 'R',
                    'weather_details' => null,
                    'going_desc' => 'Good',
                    'race_instance_uid' => 763476,
                    'race_type_code' => 'B',
                    'race_instance_title' => 'Maiden Special Weight (2yo Fillies) (Main Track) (Dirt)',
                    'race_type_desc' => 'Flat AW',
                    'race_group_uid' => 1,
                    'race_group_desc' => 'Group 1',
                    'going_type_desc' => 'Fast',
                    'surface' => 'Dirt',
                    'race_class' => 0,
                    'perform_race_uid_atr' => null,
                    'perform_race_uid_ruk' => null,
                    'rp_ages_allowed_desc' =>  '2yo',
                    'official_rating_band_desc' => 'some-text',
                    'race_datetime' => '2020-07-24T18:51:00+01:00',
                    'rp_tv_text' => 'SKY',
                    'distance_yard' => 1100,
                    'hours_difference' => 2,
                    'no_of_runners' => 7,
                    'pool_prize_sterling' => 5345.00
                ],
                [
                    'meetingId' => null,
                    'rp_meeting_order' => null,
                    'style_name' => 'LINGFIELD (A.W)',
                    'course_name' => 'Lingfield (A.W)',
                    'course_uid' => 375,
                    'early_closing_race_yn' => null,
                    'mixed_course_uid' => null,
                    'fast_race_instance_uid' => 123,
                    'country_code' => 'USA',
                    'course_type_code' => 'B',
                    'numberOfRaces' => 1,
                    'sumNonRunners' => 0,
                    'race_status_code' => 'R',
                    'weather_details' => null,
                    'going_desc' => 'Good',
                    'race_instance_uid' => 7654321,
                    'race_type_code' => 'B',
                    'race_instance_title' => 'Best Race Every',
                    'race_type_desc' => 'Flat AW',
                    'race_group_uid' => 1,
                    'race_group_desc' => 'Group 1',
                    'going_type_desc' => 'Fast',
                    'surface' => 'Dirt',
                    'race_class' => 0,
                    'perform_race_uid_atr' => null,
                    'perform_race_uid_ruk' => null,
                    'rp_ages_allowed_desc' =>  '2yo',
                    'official_rating_band_desc' => 'some-text',
                    'race_datetime' => '2020-07-24T20:51:00+01:00',
                    'rp_tv_text' => 'SKY',
                    'distance_yard' => 1100,
                    'hours_difference' => 2,
                    'no_of_runners' => 7,
                    'pool_prize_sterling' => 4345.00
                ],
                [
                    'meetingId' => null,
                    'rp_meeting_order' => null,
                    'style_name' => 'LINGFIELD (A.W)',
                    'course_name' => 'Lingfield (A.W)',
                    'course_uid' => 375,
                    'early_closing_race_yn' => null,
                    'mixed_course_uid' => null,
                    'fast_race_instance_uid' => null,
                    'race_type_code' => 'F',
                    'country_code' => 'USA',
                    'course_type_code' => 'B',
                    'weather_details' => null,
                    'going_desc' => 'Good',
                    'numberOfRaces' => 1,
                    'sumNonRunners' => 0,
                    'race_status_code' => 'C',
                    'race_group_uid' => 5,
                    'race_group_desc' => 'Listed Handicap',
                    'race_instance_uid' => 987654321,
                    'race_instance_title' => 'Peaky Blinders Race Title',
                    'race_type_desc' => 'Flat AW',
                    'going_type_desc' => 'Fast',
                    'surface' => 'Dirt',
                    'race_class' => 0,
                    'perform_race_uid_atr' => 123,
                    'perform_race_uid_ruk' => null,
                    'rp_ages_allowed_desc' =>  '2yo',
                    'official_rating_band_desc' => 'some-text',
                    'race_datetime' => '2030-01-01T18:51:00+01:00',
                    'rp_tv_text' => 'SKY',
                    'distance_yard' => 1100,
                    'hours_difference' => 5,
                    'no_of_runners' => 5,
                    'pool_prize_sterling' => 5345.00
                ],
            ],
            //Api\DataProvider\Bo\Meetings\:22 ->getTote()
            '0fa9a6109226660fc28c43d5b97843ef' => [
                [
                    'race_instance_uid' => 763476,
                    'tote_currency_code' => 'GBP',
                    'rule4_value' => null,
                    'race_status_code' => 'R',
                    'days_diff' => null,
                    'race_comments' => null,
                    'tote_deadheat_text' => null,
                    'tote_win_money' => 15.7,
                    'tote_place_1_money' => 3.8,
                    'tote_place_2_money' => 1.6,
                    'tote_place_3_money' => 1.4,
                    'tote_place_4_money' => null,
                    'tote_dual_forecast_money' => 57.03,
                    'computer_strght_frcst_money' => 57.03,
                    'tricast_money' => 359.89,
                    'tote_trio_money' => '915.7',
                    'trio_text' => '',
                    'jackpot_text' => ' ',
                    'placepot_text' => '£64.90 to a £1 stake. Pool: £64,672.95 - 726.63 winning units',
                    'quadpot_text' => '£12.40 to a £1 stake. Pool: £9,528.88 - 565.65 winning units',
                    'rule4_text' => null,
                    'selling_details_text' => null,
                    'scoop6_dividend' => null
                ],
                [
                    'race_instance_uid' => 7654321,
                    'tote_currency_code' => 'GBP',
                    'rule4_value' => null,
                    'race_status_code' => 'R',
                    'days_diff' => null,
                    'race_comments' => null,
                    'tote_deadheat_text' => null,
                    'tote_win_money' => 15.7,
                    'tote_place_1_money' => 3.8,
                    'tote_place_2_money' => 1.6,
                    'tote_place_3_money' => 1.4,
                    'tote_place_4_money' => null,
                    'tote_dual_forecast_money' => 57.03,
                    'computer_strght_frcst_money' => 57.03,
                    'tricast_money' => 359.89,
                    'tote_trio_money' => '915.7',
                    'trio_text' => '',
                    'jackpot_text' => ' ',
                    'placepot_text' => '£64.90 to a £1 stake. Pool: £64,672.95 - 726.63 winning units',
                    'quadpot_text' => '£12.40 to a £1 stake. Pool: £9,528.88 - 565.65 winning units',
                    'rule4_text' => null,
                    'selling_details_text' => null,
                    'scoop6_dividend' => null
                ]
            ],
            //Api\DataProvider\Bo\Meetings\ ->getTote()
            'e47bc12866224e6ac468a8e8cbfb569c' => [
            ],
            //Api\DataProvider\Bo\Meetings\ ->Tmp()
            '49d70cb2f0628f1ae2876a8cd284a13a' => [
            ],
            //Api\DataProvider\Bo\Meetings\ ->dropTmp()
            'fabddb1710b03508361534ea456ae438' => [
            ],
            //Api\DataProvider\Bo\Meetings\ ->getReplay()
            '10beaaaa61612758c43257e79f9dda01' => [
            ],
            //Models\Bo\Results\RaceAttribLookup\:56 ->getRaceCategory()
            '9d29f094f092188633fee8b2b32267a3' => [
            ],
            //Models\Bo\Results\RaceAttribLookup\:56 ->getRaceCategory()
            '4df82041135182e92877c823ace5ee7c' => [
            ],
            //Models\Bo\Results\RaceAttribLookup\:56 ->getRaceCategory()
            '1e0dcefbc8d19ff39eb4df2c70db71ec' => [
                [
                    'race_attrib_desc' => 'Grade 1'
                ]
            ]
        ];
    }
}
