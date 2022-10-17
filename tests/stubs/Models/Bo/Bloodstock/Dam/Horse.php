<?php

namespace Tests\Stubs\Models\Bo\Bloodstock\Dam;

class Horse extends \Tests\Stubs\Models\Horse
{
    /**
     * @param \Api\Input\Request\Horses\Bloodstock\Dam\ProgenyResultsDefault $request
     *
     * @return array
     */
    public function getProgenyResults(\Api\Input\Request\Horses\Bloodstock\Dam\ProgenyResultsDefault $request)
    {
        $data =
        [
            585723 => [
                'FLAT' => [
                    \Api\Row\Ads\WinnerAndRaceInfo::createFromArray([
                        'main_type' => 'FLAT',
                        'horse_uid' => 826492,
                        'style_name' => 'Australia',
                        'country_origin_code' => 'GB',
                        'h_yob' => 2011,
                        'horse_sex_code' => 'C',
                        'runs' => 8,
                        'wins' => 5,
                        'places' => 3,
                        'total_prize_money' => 2090502.8781,
                        'stakes_winner' => 6,
                        'sire_uid' => 82642,
                        'sire_style_name' => 'Galileo',
                        'sire_country_origin_code' => 'IRE',
                        'rp_postmark' => 129,
                        'avg_flat_win_dist_of_progeny' => 11.2,
                        'distance_yard' => 1223,
                        'place_1st_number' => 5,
                        'races_number' => 8,
                        'trainer_uid' => 7978,
                        'trainer_name' => 'A P O\'Brien'
                    ]),
                    \Api\Row\Ads\WinnerAndRaceInfo::createFromArray([
                        'main_type' => 'FLAT',
                        'horse_uid' => 826493,
                        'style_name' => 'Australia',
                        'country_origin_code' => 'GB',
                        'h_yob' => 2011,
                        'horse_sex_code' => 'C',
                        'runs' => 8,
                        'wins' => 5,
                        'places' => 3,
                        'total_prize_money' => 2090502.8781,
                        'stakes_winner' => 6,
                        'sire_uid' => 82642,
                        'sire_style_name' => 'Galileo',
                        'sire_country_origin_code' => 'IRE',
                        'rp_postmark' => 129,
                        'avg_flat_win_dist_of_progeny' => null,
                        'distance_yard' => 1223,
                        'place_1st_number' => 4,
                        'races_number' => 27,
                        'trainer_uid' => 13495,
                        'trainer_name' => 'Chris Waller'
                    ]),
                ],
                'JUMPS' => [
                    \Api\Row\Ads\WinnerAndRaceInfo::createFromArray([
                        'main_type' => 'JUMPS',
                        'horse_uid' => 826494,
                        'style_name' => 'Australia',
                        'country_origin_code' => 'GB',
                        'h_yob' => 2011,
                        'horse_sex_code' => 'C',
                        'runs' => 8,
                        'wins' => 5,
                        'places' => 3,
                        'total_prize_money' => 2090502.8781,
                        'stakes_winner' => 6,
                        'sire_uid' => 82642,
                        'sire_style_name' => 'Galileo',
                        'sire_country_origin_code' => 'IRE',
                        'rp_postmark' => 129,
                        'avg_flat_win_dist_of_progeny' => null,
                        'distance_yard' => 1223,
                        'place_1st_number' => 4,
                        'races_number' => 27,
                        'trainer_uid' => 13495,
                        'trainer_name' => 'Chris Waller'
                    ]),
                ],
            ],
            585725 => [
                'FLAT' => [
                    \Api\Row\Ads\WinnerAndRaceInfo::createFromArray([
                        'main_type' => 'FLAT',
                        'horse_uid' => 826494,
                        'style_name' => 'Australia',
                        'country_origin_code' => 'GB',
                        'h_yob' => 2011,
                        'horse_sex_code' => 'C',
                        'runs' => 8,
                        'wins' => 5,
                        'places' => 3,
                        'total_prize_money' => 2090502.8781,
                        'stakes_winner' => 6,
                        'sire_uid' => 82642,
                        'sire_style_name' => 'Galileo',
                        'sire_country_origin_code' => 'IRE',
                        'rp_postmark' => 129,
                        'avg_flat_win_dist_of_progeny' => null,
                        'distance_yard' => 1223,
                        'place_1st_number' => 4,
                        'races_number' => 27,
                        'trainer_uid' => 13495,
                        'trainer_name' => 'Chris Waller'
                    ]),
                ],
                'JUMPS' => [
                    \Api\Row\Ads\WinnerAndRaceInfo::createFromArray([
                        'main_type' => 'JUMPS',
                        'horse_uid' => 826492,
                        'style_name' => 'Australia',
                        'country_origin_code' => 'GB',
                        'h_yob' => 2011,
                        'horse_sex_code' => 'C',
                        'runs' => 8,
                        'wins' => 5,
                        'places' => 3,
                        'total_prize_money' => 2090502.8781,
                        'stakes_winner' => 6,
                        'sire_uid' => 82642,
                        'sire_style_name' => 'Galileo',
                        'sire_country_origin_code' => 'IRE',
                        'rp_postmark' => 129,
                        'avg_flat_win_dist_of_progeny' => 11.2,
                        'distance_yard' => 1223,
                        'place_1st_number' => 5,
                        'races_number' => 8,
                        'trainer_uid' => 7978,
                        'trainer_name' => 'A P O\'Brien'
                    ]),
                    \Api\Row\Ads\WinnerAndRaceInfo::createFromArray([
                        'main_type' => 'JUMPS',
                        'horse_uid' => 826493,
                        'style_name' => 'Australia',
                        'country_origin_code' => 'GB',
                        'h_yob' => 2011,
                        'horse_sex_code' => 'C',
                        'runs' => 8,
                        'wins' => 5,
                        'places' => 3,
                        'total_prize_money' => 2090502.8781,
                        'stakes_winner' => 6,
                        'sire_uid' => 82642,
                        'sire_style_name' => 'Galileo',
                        'sire_country_origin_code' => 'IRE',
                        'rp_postmark' => 129,
                        'avg_flat_win_dist_of_progeny' => null,
                        'distance_yard' => 1223,
                        'place_1st_number' => 4,
                        'races_number' => 27,
                        'trainer_uid' => 13495,
                        'trainer_name' => 'Chris Waller'
                    ]),
                ],
            ],
            585726 => [
                'FLAT' => [
                    \Api\Row\Ads\WinnerAndRaceInfo::createFromArray([
                        'main_type' => 'FLAT',
                        'horse_uid' => 826492,
                        'style_name' => 'Australia',
                        'country_origin_code' => 'GB',
                        'h_yob' => 2011,
                        'horse_sex_code' => 'C',
                        'runs' => 8,
                        'wins' => 5,
                        'places' => 3,
                        'total_prize_money' => 2090502.8781,
                        'stakes_winner' => 6,
                        'sire_uid' => 82642,
                        'sire_style_name' => 'Galileo',
                        'sire_country_origin_code' => 'IRE',
                        'rp_postmark' => 129,
                        'avg_flat_win_dist_of_progeny' => 11.2,
                        'distance_yard' => 1223,
                        'place_1st_number' => 5,
                        'races_number' => 8,
                        'trainer_uid' => 7978,
                        'trainer_name' => 'A P O\'Brien'
                    ]),
                ],
                'JUMPS' => [
                    \Api\Row\Ads\WinnerAndRaceInfo::createFromArray([
                        'main_type' => 'JUMPS',
                        'horse_uid' => 826493,
                        'style_name' => 'Australia',
                        'country_origin_code' => 'GB',
                        'h_yob' => 2011,
                        'horse_sex_code' => 'C',
                        'runs' => 8,
                        'wins' => 5,
                        'places' => 3,
                        'total_prize_money' => 2090502.8781,
                        'stakes_winner' => 6,
                        'sire_uid' => 82642,
                        'sire_style_name' => 'Galileo',
                        'sire_country_origin_code' => 'IRE',
                        'rp_postmark' => 129,
                        'avg_flat_win_dist_of_progeny' => null,
                        'distance_yard' => 1223,
                        'place_1st_number' => 4,
                        'races_number' => 27,
                        'trainer_uid' => 13495,
                        'trainer_name' => 'Chris Waller'
                    ]),
                ],
            ]
        ];

        return $data[$request->getDamId()];
    }
}
