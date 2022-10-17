<?php

namespace Tests\Stubs\Models\Bo\RaceCards;

use Api\Row\Results\Horse as HorseRow;
use Phalcon\Mvc\Model\Row\General as GeneralRow;

/**
 * Class Runners
 *
 * @package Tests\Stubs\Models\Bo\RaceCards
 */
class Runners extends RaceInstance
{
    /**
     * @param $raceId
     *
     * @return \Api\Row\RaceInstance
     */
    public function getRunners($raceId)
    {
        $data = [
            688111 => [
                1314524 => HorseRow::createFromArray([
                    'start_number' => 1,
                    'draw' => 0,
                    'race_type_code' => 'X',
                    'race_status_code' => '4',
                    'distance_yard' => 1760,
                    'track_code' => null,
                    'course_uid' => 1083,
                    'straight_round_jubilee_code' => null,
                    'owner_uid' => 16463,
                    'owner_name' => 'Mrs P A Clark',
                    'eliminator_no' => 0,
                    'horse_uid' => 1314524,
                    'horse_name' => 'Trevithick',
                    'country_origin_code' => 'GB',
                    'race_instance_uid' => 688111,
                    'race_datetime' => 'Nov 23 2017  6:30PM',
                    'rp_horse_head_gear_code' => null,
                    'first_time_yn' => null,
                    'extra_weight_lbs' => 0,
                    'horse_age' => 2,
                    'weight_carried_lbs' => 134,
                    'official_rating' => null,
                    'official_rating_today' => null,
                    'jockey_uid' => null,
                    'jockey_name' => null,
                    'weight_allowance_lbs' => 0,
                    'trainer_id' => 373,
                    'trainer_stylename' => 'Bryan Smart',
                    'country_code' => 'GB',
                    'rp_topspeed' => null,
                    'rp_postmark' => null,
                    'rp_owner_choice' => 'a',
                    'non_runner' => null,
                    'irish_reserve_yn' => 'N',
                    'allowance' => null,
                    'extra_weight' => null,
                    'horse_colour_code' => 'B',
                    'horse_sex_code' => 'C',
                    'sire_id' => 647498,
                    'sire_name' => 'Champs Elysees',
                    'sire_country' => 'GB',
                    'dam_id' => 774482,
                    'dam_name' => 'New Choice',
                    'dam_country' => 'IRE',
                    'damsire_id' => 72922,
                    'damsire_name' => 'Barathea',
                    'damsire_country' => 'IRE',
                    'spotlight' => null,
                    'diomed' => null,
                    'figures' => null,
                    'course_country_code' => 'GB ',
                    'figures_calculated' => null,
                    'new_trainer_races_count' => null,
                    'plus10_horse' => 'N',
                    'yearling_bonus_horse' => 'N',
                    'lh_weight_carried_lbs' => null,
                    'out_of_handicap' => null,
                    'beaten_favourite' => 'N',
                    'forecast_odds_value' => null,
                    'forecast_odds_desc' => null,
                    'course_and_distance_wins' => 0,
                    'course_wins' => 0,
                    'distance_wins' => 0,
                    'running_conditions' => null,
                    'date_gelded' => '2017-12-10',
                    'gelding_first_time' => 0,
                    'rp_postmark_improver' => 'N',
                    'wfa_adjustment' => 22,
                    'information_receipt_date' => null,
                    'saddle_cloth_no' => 1,
                    'style_name' => 'Antey',
                    'is_wind_surgery_first_time' => 'N',
                ]),
                1692228 => HorseRow::createFromArray([
                    'start_number' => 2,
                    'draw' => 0,
                    'race_type_code' => 'X',
                    'race_status_code' => '4',
                    'distance_yard' => 1760,
                    'track_code' => null,
                    'course_uid' => 1083,
                    'straight_round_jubilee_code' => null,
                    'owner_uid' => 154370,
                    'owner_name' => 'Nurlan Bizakov',
                    'eliminator_no' => 0,
                    'horse_uid' => 1692228,
                    'horse_name' => 'Balkhash',
                    'country_origin_code' => 'IRE',
                    'race_instance_uid' => 688111,
                    'race_datetime' => 'Nov 23 2017  6:30PM',
                    'rp_horse_head_gear_code' => null,
                    'first_time_yn' => null,
                    'extra_weight_lbs' => 0,
                    'horse_age' => 2,
                    'weight_carried_lbs' => 128,
                    'official_rating' => null,
                    'official_rating_today' => null,
                    'jockey_uid' => null,
                    'jockey_name' => null,
                    'weight_allowance_lbs' => 0,
                    'trainer_id' => 5863,
                    'trainer_stylename' => 'Clive Cox',
                    'country_code' => 'GB',
                    'rp_topspeed' => null,
                    'rp_postmark' => null,
                    'rp_owner_choice' => 'a',
                    'non_runner' => null,
                    'irish_reserve_yn' => 'N',
                    'allowance' => null,
                    'extra_weight' => null,
                    'horse_colour_code' => 'B',
                    'horse_sex_code' => 'C',
                    'sire_id' => 647498,
                    'sire_name' => 'Champs Elysees',
                    'sire_country' => 'GB',
                    'dam_id' => 755917,
                    'dam_name' => 'Balatoma',
                    'dam_country' => 'IRE',
                    'damsire_id' => 98576,
                    'damsire_name' => 'Mr Greeley',
                    'damsire_country' => 'USA',
                    'spotlight' => null,
                    'diomed' => null,
                    'figures' => null,
                    'course_country_code' => 'GB ',
                    'figures_calculated' => null,
                    'new_trainer_races_count' => null,
                    'plus10_horse' => 'Y',
                    'yearling_bonus_horse' => 'N',
                    'lh_weight_carried_lbs' => null,
                    'out_of_handicap' => null,
                    'beaten_favourite' => 'N',
                    'forecast_odds_value' => null,
                    'forecast_odds_desc' => null,
                    'course_and_distance_wins' => 0,
                    'course_wins' => 0,
                    'distance_wins' => 0,
                    'running_conditions' => null,
                    'date_gelded' => null,
                    'gelding_first_time' => 0,
                    'rp_postmark_improver' => 'N',
                    'wfa_adjustment' => 22,
                    'information_receipt_date' => null,
                    'saddle_cloth_no' => 2,
                    'style_name' => 'Annamix',
                    'is_wind_surgery_first_time' => 'N',
                ]),
            ],
            1 => [],
        ];

        return $data[$raceId];
    }

    /**
     * Get gelding first time runners
     *
     * @param int $raceId
     *
     * @return array
     */
    public function getGeldingFirstTimeRunners($raceId)
    {
        $arr = [
            688111 => [
                '1314524' => GeneralRow::createFromArray(
                    [
                        'horse_uid' => 1314524,
                    ]
                ),
            ],
        ];

        return $arr[$raceId];
    }

    /**
     * @param $horseUids
     * @param $raceType
     * @param $raceDatetime
     *
     * @return mixed
     */
    public function getBeatenFavourites($horseUids, $raceType, $raceDatetime)
    {
        $data = [
            '887786 880523' => [
                '880523' => GeneralRow::createFromArray(
                    [
                        'horse_uid' => 880523,
                    ]
                ),
            ],
            '889897' => [],
            '1314524 1692228' => [],
            '' => [],
        ];

        return $data[implode(' ', $horseUids)];
    }

    /**
     * @param $horseUids
     * @param $raceType
     * @param $raceDatetime
     *
     * @return mixed
     */
    public function getHorseForms($horseUids, $raceType, $raceDatetime)
    {
        $data = [
            '1314524_1692228_X' => [
                1314524 => [
                    GeneralRow::createFromArray([
                        'horse_uid' => 1314524,
                        'distance_yard' => 1765,
                        'straight_round_jubilee_code' => null,
                        'track_code' => null,
                        'course_uid' => 1353,
                        'race_type_code' => 'X',
                        'country_code' => 'GB ',
                    ]),
                ],
            ],
            '' => [],
        ];

        return $data[implode('_', $horseUids) . '_' . $raceType];
    }

    /**
     * @param $horseIds
     * @param $raceDate
     *
     * @return mixed
     */
    public function getDaysSinceLastRun($horseIds, $raceDate)
    {
        $data = [
            '1314524_1692228' => [
                1314524 => [
                    GeneralRow::createFromArray([
                        'horse_uid' => 1314524,
                        'race_type_code' => 'flat',
                        'days_since_run' => 8,
                    ]),
                ],
                1692228 => [
                    GeneralRow::createFromArray([
                        'horse_uid' => 1692228,
                        'race_type_code' => 'flat',
                        'days_since_run' => 15,
                    ]),
                ],
            ],
            111111 => [],
        ];

        return $data[implode('_', $horseIds)];
    }

    /**
     * Fetch RP Ratings improver data for each runner in a given race
     *
     * @param array  $horseIds
     * @param string $raceDate
     * @param string $raceType
     *
     * @return array
     */
    public function fetchImproverData($horseIds, $raceDate, $raceType)
    {
        $data = [
            '1314524_1692228' => [
                1314524 => [
                    GeneralRow::createFromArray([
                        'horse_uid' => 1314524,
                        'date_diff' => 6,
                        'race_type_code' => 'X',
                        'position' => '1  ',
                        'favourite_flag' => 'qq',
                        'rp_postmark' => 81,
                    ]),
                    GeneralRow::createFromArray([
                        'horse_uid' => 1314524,
                        'date_diff' => 20,
                        'race_type_code' => 'F',
                        'position' => '8  ',
                        'favourite_flag' => 'qq',
                        'rp_postmark' => 53,
                    ]),
                ],
                1692228 => [
                    GeneralRow::createFromArray([
                        'horse_uid' => 1692228,
                        'date_diff' => 13,
                        'race_type_code' => 'F',
                        'position' => '9  ',
                        'favourite_flag' => 'qq',
                        'rp_postmark' => 57,
                    ]),
                ],
            ],
        ];

        return $data[implode('_', $horseIds)];
    }
}
