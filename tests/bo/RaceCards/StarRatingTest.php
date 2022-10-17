<?php
/**
 * Created by PhpStorm.
 * User: Andriy_Zubrytskyy
 * Date: 1/13/2017
 * Time: 3:43 PM
 */

namespace Tests;

use \Api\Input\Request\Horses\RaceCards\StartRating as Request;
use Tests\Stubs\Bo\RaceCards;

class StarRatingTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Api\Input\Request\Horses\RaceCards\StartRating $request
     * @param array $expected
     * @dataProvider providerGetStartRating
     */
    public function testGetStartRating(Request $request, $expected)
    {
        $bo = new RaceCards($request);
        $actual = $bo->getStartRating($request);
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @return array
     */
    public function providerGetStartRating()
    {
        return [
            [
                new Request([], ['raceId' => 677649]),
                \Api\Row\RaceInstance::createFromArray([
                    'race_instance_title' => 'High Definition Racing UK Next Month Novices\' Hurdle',
                    'rp_ages_allowed_desc' => '4yo+',
                    'race_class' => '4',
                    'official_rating_band_desc' => null,
                    'race_datetime' => date("Y-m-d ") . '12:00',
                    'three_yo_min_weight_lbs' => null,
                    'minimum_weight_lbs' => null,
                    'declared_runners' => 16,
                    'no_of_runners' => 15,
                    'distance_yard' => 3471,
                    'rp_tv_text' => 'RUK',
                    'going_type_desc' => 'Good To Soft',
                    'rp_penalties' => 'each hurdle won 7lb',
                    'course_uid' => 26,
                    'mixed_course_uid' => null,
                    'course_name' => 'HUNTINGDON',
                    'course_style_name' => 'Huntingdon',
                    'rp_horse_types' => '4yo+ which have not won more than three hurdles',
                    'rp_weights' => '4yo 10st 7lb; 5yo+ 11st 2lb',
                    'allowances' => 'fillies & mares 7lb',
                    'entry_fee' => 25,
                    'extra_fee' => null,
                    'country_code' => 'GB ',
                    'foreign' => 0,
                    'rp_stakes' => 5000,
                    'rp_ag_indicator' => 'G',
                    'weights_raised_lbs' => null,
                    'rp_auction_min' => null,
                    'rp_claim_min' => null,
                    'rp_confirmed' => null,
                    'race_status_code' => 'R',
                    'race_type_code' => 'H',
                    'race_group_desc' => null,
                    'going_type_code' => 'GS',
                    'no_of_fences' => 8,
                    'no_of_entries' => 45,
                    'rp_stalls_position' => ' ',
                    'race_group_code' => 'H',
                    'minimum_weight_lbs1' => null,
                    'safety_factor_number' => 16,
                    'early_closing_race_yn' => null,
                    'reopened_yn' => 'N',
                    'division_preference' => 2,
                    'last_year' => 'GRAND MARCH, 06-11-11, David Bass, 3-1 (Kim Bailey) 07 ran.',
                    'highest_official_rating' => null,
                    'scoop6_race' => 'N',
                    'jackpot_race' => 'N',
                    'william_hill_offer_race' => 'N',
                    'ladbrokes_offer_race' => 'N',
                    'perform_race_uid_atr' => 111773,
                    'perform_race_uid_ruk' => null,
                    'aw_surface_type' => null,
                    'stalls_position_desc' => null,
                    'straight_round_jubilee_code' => null,
                    'live_tab' => 'Y',
                    'claiming_race' => 'Y',
                    'selling_race' => 'N',
                    'plus10_race' => 'Y',
                    'weight_for_age' => null,
                    'horses' => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'start_number' => 1,
                                'horse_uid' => 1444076,
                                'horse_name' => 'Branscombe',
                                'non_runner' => null,
                                'star_rating' => null,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'start_number' => 4,
                                'horse_uid' => 1428792,
                                'horse_name' => 'Fortunate Vision',
                                'non_runner' => 'Y',
                                'star_rating' => null,
                            ]
                        ),
                    ]
                ])
            ]
        ];
    }
}
