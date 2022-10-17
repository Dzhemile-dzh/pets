<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\RaceCards\RaceCard;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\RaceCards\Runners
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/racecards/701986';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models\Bo\RaceCards\RaceInstance:832 ->getRaceCard()
            'b30406ace53f43c79fd7d398beeaf2c7' => [
                [
                    'race_instance_title' => 'Netbet Sport Best Odds Guaranteed Conditional Jockeys\' Mares\' Handicap Hurdle',
                    'rp_ages_allowed_desc' => '4yo+',
                    'race_class' => '5',
                    'official_rating_band_desc' => '0-100',
                    'race_datetime' => '2018-06-05 14:15:00',
                    'local_meeting_race_datetime' => '2018-06-05 14:15:00',
                    'hours_difference' => 0,
                    'three_yo_min_weight_lbs' => null,
                    'four_yo_min_weight_lbs' => null,
                    'minimum_weight_lbs' => 140,
                    'declared_runners' => 10,
                    'no_of_runners' => 10,
                    'distance_yard' => 3902,
                    'rp_tv_text' => 'ATR',
                    'going_type_desc' => 'Good',
                    'rp_penalties' => 'after May 26th, each hurdle won 7lb',
                    'course_uid' => 20,
                    'mixed_course_uid' => null,
                    'course_name' => 'FONTWELL',
                    'course_style_name' => 'Fontwell',
                    'course_region' => 'GB & IRE',
                    'rp_horse_types' => '4yo+ fillies & mares Rated 0-100 (also open to such horses rated 101 and 102 - see Standard Conditions)',
                    'rp_weights' => '',
                    'allowances' => 'riders who, prior to June 2nd, 2018, have not ridden more than 20 winners under any Rules of Racing 3lb; 10 such winners 5lb; 5 such winners 7lb; riders riding for their own stable allowed, in addition 3lb',
                    'entry_fee' => 22,
                    'extra_fee' => null,
                    'country_code' => 'GB ',
                    'foreign' => 0,
                    'rp_stakes' => 6321.0,
                    'rp_ag_indicator' => 'G',
                    'weights_raised_lbs' => 1,
                    'rp_auction_min' => null,
                    'rp_claim_min' => null,
                    'rp_confirmed' => null,
                    'race_status_code' => 'R',
                    'race_type_code' => 'B',
                    'race_group_desc' => 'Handicap',
                    'going_type_code' => 'G',
                    'no_of_fences' => 9,
                    'no_of_entries' => 16,
                    'rp_stalls_position' => ' ',
                    'stage' => null,
                    'forfeit_number' => null,
                    'forfeit_value' => null,
                    'race_group_code' => 'H',
                    'safety_factor_number' => 16,
                    'early_closing_race_yn' => null,
                    'reopened_yn' => 'N',
                    'division_preference' => null,
                    'prev_year_datetime' => '2018-06-05 14:15:00',
                    'prev_runners' => 20,
                    'prev_horse_name' => 'Red Balloons',
                    'prev_draw' => null,
                    'prev_trainer' => 'Richard Fahey',
                    'prev_horse_age' => 2,
                    'prev_weight_carried' => 118,
                    'prev_odds' => '33/1',
                    'prev_jockey' => 'Barry McHugh',
                    'prev_w_allowance' => null,
                    'prev_rating' => 'RPR87',
                    'highest_official_rating' => null,
                    'scoop6_race' => 'N',
                    'lucky7_race' => 'N',
                    'jackpot_race' => 'N',
                    'william_hill_offer_race' => 'N',
                    'ladbrokes_offer_race' => 'N',
                    'perform_race_uid_atr' => 328345,
                    'perform_race_uid_ruk' => null,
                    'livestream_uid' => null,
                    'lookup_uid' => 11,
                    'int_1' => 123,
                    'aw_surface_type' => null,
                    'stalls_position_desc' => null,
                    'straight_round_jubilee_code' => null,
                    'live_tab' => 'Y',
                    'claiming_race' => 'N',
                    'selling_race' => 'N',
                    'plus10_race' => 'N',
                    'race_number' => 1,
                    'weight_allowance_lbs' => 1,
                    'ages_allowed_uid' => 21
                ],
            ],
            //Models\Bo\RaceCards\RaceInstance:1738 ->getHighestOfficialRating()
            '2334de16030cdfad009df94dd5dd6bf0' => [
                [
                    'horse_uid' => 969025,
                    'start_number' => 1,
                    'horse_name' => 'Theatre Rouge',
                    'country_origin_code' => 'IRE',
                    'official_rating' => 99,
                    'weight_carried_lbs' => 166,
                ],
                [
                    'horse_uid' => 888963,
                    'start_number' => 2,
                    'horse_name' => 'Carraigin Aonair',
                    'country_origin_code' => 'IRE',
                    'official_rating' => 97,
                    'weight_carried_lbs' => 164,
                ],
                [
                    'horse_uid' => 903943,
                    'start_number' => 3,
                    'horse_name' => 'Westerbee',
                    'country_origin_code' => 'IRE',
                    'official_rating' => 95,
                    'weight_carried_lbs' => 162,
                ],
                [
                    'horse_uid' => 1044041,
                    'start_number' => 4,
                    'horse_name' => 'Kiruna Peak',
                    'country_origin_code' => 'IRE',
                    'official_rating' => 94,
                    'weight_carried_lbs' => 158,
                ],
                [
                    'horse_uid' => 1178848,
                    'start_number' => 5,
                    'horse_name' => 'Ruby Russet',
                    'country_origin_code' => 'GB',
                    'official_rating' => 90,
                    'weight_carried_lbs' => 157,
                ],
                [
                    'horse_uid' => 938282,
                    'start_number' => 6,
                    'horse_name' => 'Lady Longshot',
                    'country_origin_code' => 'GB',
                    'official_rating' => 88,
                    'weight_carried_lbs' => 155,
                ],
                [
                    'horse_uid' => 1021466,
                    'start_number' => 8,
                    'horse_name' => 'Let\'s Be Happy',
                    'country_origin_code' => 'IRE',
                    'official_rating' => 86,
                    'weight_carried_lbs' => 150,
                ],
                [
                    'horse_uid' => 1205113,
                    'start_number' => 7,
                    'horse_name' => 'Sugar Storm',
                    'country_origin_code' => 'GB',
                    'official_rating' => 86,
                    'weight_carried_lbs' => 153,
                ],
                [
                    'horse_uid' => 841587,
                    'start_number' => 9,
                    'horse_name' => 'Olymnia',
                    'country_origin_code' => 'GB',
                    'official_rating' => 79,
                    'weight_carried_lbs' => 146,
                ],
                [
                    'horse_uid' => 824468,
                    'start_number' => 10,
                    'horse_name' => 'Oh Dear Oh Dear',
                    'country_origin_code' => 'GB',
                    'official_rating' => 67,
                    'weight_carried_lbs' => 140,
                ],
            ],
            //Models\RaceInstancePrize:228 ->getForRaceInstanceId()
            '8f96d37bde87d44ec8d7b4b58c3f88f5' => [
                [
                    'position_no' => 1,
                    'prize_sterling' => 3119.04,
                    'prize_euro' => null,
                    'prize_usd' => 4210.7,
                ],
                [
                    'position_no' => 2,
                    'prize_sterling' => 915.84,
                    'prize_euro' => null,
                    'prize_usd' => 1236.38,
                ],
                [
                    'position_no' => 3,
                    'prize_sterling' => 457.92,
                    'prize_euro' => null,
                    'prize_usd' => 618.19,
                ],
                [
                    'position_no' => 4,
                    'prize_sterling' => 350.0,
                    'prize_euro' => null,
                    'prize_usd' => 472.5,
                ],
                [
                    'position_no' => 5,
                    'prize_sterling' => 350.0,
                    'prize_euro' => null,
                    'prize_usd' => 472.5,
                ],
                [
                    'position_no' => 6,
                    'prize_sterling' => 350.0,
                    'prize_euro' => null,
                    'prize_usd' => 472.5,
                ],
                [
                    'position_no' => 7,
                    'prize_sterling' => 350.0,
                    'prize_euro' => null,
                    'prize_usd' => 472.5,
                ],
                [
                    'position_no' => 8,
                    'prize_sterling' => 350.0,
                    'prize_euro' => null,
                    'prize_usd' => 472.5,
                ],
            ],
            //Models\Bo\RaceCards\RaceInstance:1269 ->getOtherDeclaration()
            '23f076ea1a847e474f848acdd64d6a4f' => [
            ],
            //Models\Bo\RaceCards\RaceInstance:1304 ->getForfeits()
            '67ca86684f5ee4cbd7d3e44d04afddaa' => [
            ],
            //Api\DataProvider\Bo\RaceCards\RaceWFA:96 ->getRaceInfo()
            '54a0a456c2987f7f7238e19e3530a14b' => [
                [
                    'race_type_code' => 'H',
                    'race_datetime' => '2018-06-05 14:15:00',
                    'race_status_code' => 'R',
                    'distance_yard' => 3902,
                    'going_type_code' => 'G',
                ],
            ],
            //Api\DataProvider\Bo\RaceCards\RaceWFA:64 ->getTopStats()
            '7189ce6ec563792461c4a18d52444759' => [
                [
                    'max_age' => 10,
                    'min_age' => 4,
                    'top_age' => 6,
                ],
            ],
            //Api\DataProvider\Bo\RaceCards\RaceWFA:226 ->getRaceHorses()
            '38a34f34570ab0c7fcc9c0042552f086' => [
                [
                    'horse_uid' => 1021466,
                    'adjusted_age' => 4,
                    'age' => 4,
                    'weight_carried_lbs' => 150,
                    'wfage' => 4,
                    'wfa' => 0,
                    'currhp' => 0,
                    'currhp2' => 0,
                    'lsnum' => 0,
                    'lsnum2' => 0,
                ],
                [
                    'horse_uid' => 1044041,
                    'adjusted_age' => 4,
                    'age' => 4,
                    'weight_carried_lbs' => 158,
                    'wfage' => 4,
                    'wfa' => 0,
                    'currhp' => 0,
                    'currhp2' => 0,
                    'lsnum' => 0,
                    'lsnum2' => 0,
                ],
                [
                    'horse_uid' => 969025,
                    'adjusted_age' => 5,
                    'age' => 6,
                    'weight_carried_lbs' => 166,
                    'wfage' => 4,
                    'wfa' => 0,
                    'currhp' => 0,
                    'currhp2' => 0,
                    'lsnum' => 0,
                    'lsnum2' => 0,
                ],
                [
                    'horse_uid' => 888963,
                    'adjusted_age' => 5,
                    'age' => 6,
                    'weight_carried_lbs' => 164,
                    'wfage' => 4,
                    'wfa' => 0,
                    'currhp' => 0,
                    'currhp2' => 0,
                    'lsnum' => 0,
                    'lsnum2' => 0,
                ],
                [
                    'horse_uid' => 1178848,
                    'adjusted_age' => 5,
                    'age' => 6,
                    'weight_carried_lbs' => 157,
                    'wfage' => 4,
                    'wfa' => 0,
                    'currhp' => 0,
                    'currhp2' => 0,
                    'lsnum' => 0,
                    'lsnum2' => 0,
                ],
                [
                    'horse_uid' => 903943,
                    'adjusted_age' => 5,
                    'age' => 7,
                    'weight_carried_lbs' => 162,
                    'wfage' => 4,
                    'wfa' => 0,
                    'currhp' => 0,
                    'currhp2' => 0,
                    'lsnum' => 0,
                    'lsnum2' => 0,
                ],
                [
                    'horse_uid' => 938282,
                    'adjusted_age' => 5,
                    'age' => 7,
                    'weight_carried_lbs' => 155,
                    'wfage' => 4,
                    'wfa' => 0,
                    'currhp' => 0,
                    'currhp2' => 0,
                    'lsnum' => 0,
                    'lsnum2' => 0,
                ],
                [
                    'horse_uid' => 841587,
                    'adjusted_age' => 5,
                    'age' => 7,
                    'weight_carried_lbs' => 146,
                    'wfage' => 4,
                    'wfa' => 0,
                    'currhp' => 0,
                    'currhp2' => 0,
                    'lsnum' => 0,
                    'lsnum2' => 0,
                ],
                [
                    'horse_uid' => 1205113,
                    'adjusted_age' => 5,
                    'age' => 7,
                    'weight_carried_lbs' => 153,
                    'wfage' => 4,
                    'wfa' => 0,
                    'currhp' => 0,
                    'currhp2' => 0,
                    'lsnum' => 0,
                    'lsnum2' => 0,
                ],
                [
                    'horse_uid' => 824468,
                    'adjusted_age' => 5,
                    'age' => 10,
                    'weight_carried_lbs' => 140,
                    'wfage' => 4,
                    'wfa' => 0,
                    'currhp' => 0,
                    'currhp2' => 0,
                    'lsnum' => 0,
                    'lsnum2' => 0,
                ],
            ],
            //Api\DataProvider\Bo\RaceCards\RaceWFA:303 ->getWfAgesJumps()
            '4051c7c91f5abef5dcd8fed3ed74f9d2' => [
                [
                    'age' => 4,
                    'wfa' => 17,
                    'race_type_code' => 'C',
                ],
                [
                    'age' => 4,
                    'wfa' => 3,
                    'race_type_code' => 'H',
                ],
            ],
            //Api\DataProvider\Bo\RaceCards:832 ->getRaceAttributes()
            '508fd78942e2e8ef057a6bab579f7c8e' => [
                [
                    'race_attrib_desc' => "5",
                    'race_attrib_code' => 'Class_subset',
                    'race_attrib_uid'  => 85,
                ]
            ],
            //Api\DataProvider\Bo\RaceCards:832 ->getCourseMap()
            '516a96835c5d39665bcea304c8487fb8' => [
                [
                    'course_uid' => 4,
                    'course_name' => 'BANGOR-ON-DEE',
                    'latitude' => '53.520301',
                    'longitude' => '-1.106421',
                    'zoom' => '15',
                    'country_code' => 'GB',
                    'course_type_code' => 'B',
                    'race_type_code' => 'U',
                    'straight_round_jubilee' => 'null',
                    'course_comment' => 'left-handed, galloping track',
                    'rp_detailed_flat_desc' => 'Left-handed, pear-shaped, galloping. Almost 2m round with 4 1/2f run-in. Round and straight miles. Mainly flat, providing fair test.',
                    'rp_detailed_aw_desc' => 'null',
                    'rp_detailed_jump_desc' => 'Left-handed, galloping, generally flat. Heavy ground rare. Circuit 2m.',
                    'rp_detailed_hurdle_desc' => 'null',
                    'rp_detailed_chase_desc' => 'null'
                ]
            ],
        ];
    }
}
