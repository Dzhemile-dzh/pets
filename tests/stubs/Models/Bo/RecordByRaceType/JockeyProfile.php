<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 9/22/2016
 * Time: 3:41 PM
 */

namespace Tests\Stubs\Models\Bo\RecordByRaceType;

class JockeyProfile extends \Models\Bo\RecordByRaceType\JockeyProfile
{
    use \Tests\Stubs\Models\StubDataGetter;
    /**
     * @param $request
     *
     * @return array
     */
    public function getRecordByRaceType(\Api\Input\Request\HorsesRequest $request)
    {
        $key  = self::getRequestKey($request);
        $data = [
            'GB_flat_2015_2016_75506' => [
                "2YO AW" => [
                    "group_name" => "2YO AW",
                    "races_number" => 26,
                    "place_1st_number" => 6,
                    "place_2nd_number" => 4,
                    "place_3rd_number" => 5,
                    "place_4th_number" => 0,
                    "win_prize" => 18824.79,
                    "total_prize" => 25464.46,
                    "euro_win_prize" => 22024.08,
                    "euro_total_prize" => 29792.88,
                    "stake" => -2.38,
                    "win_percent" => 23,
                    "horses" => 22,
                    "placed" => 14,
                    "horse_uid" => 875054,
                    "horse_name" => "Zhui Feng",
                    "best_rp_postmark" => 87
                ],
                "2YO TURF" => [
                    "group_name" => "2YO TURF",
                    "races_number" => 154,
                    "place_1st_number" => 25,
                    "place_2nd_number" => 24,
                    "place_3rd_number" => 17,
                    "place_4th_number" => 19,
                    "win_prize" => 140826.84,
                    "total_prize" => 277409.37,
                    "euro_win_prize" => 164767.4,
                    "euro_total_prize" => 324568.53,
                    "stake" => -53.25,
                    "win_percent" => 16,
                    "horses" => 108,
                    "placed" => 57,
                    "horse_uid" => 878653,
                    "horse_name" => "Twin Sails",
                    "best_rp_postmark" => 105
                ],
                "3YO AW" => [
                    "group_name" => "3YO AW",
                    "races_number" => 36,
                    "place_1st_number" => 2,
                    "place_2nd_number" => 8,
                    "place_3rd_number" => 7,
                    "place_4th_number" => 10,
                    "win_prize" => 5822.1,
                    "total_prize" => 28208.1,
                    "euro_win_prize" => 7924.23,
                    "euro_total_prize" => 32367.45,
                    "stake" => -27.75,
                    "win_percent" => 6,
                    "horses" => 33,
                    "placed" => 13,
                    "horse_uid" => 855899,
                    "horse_name" => "Lexington Times",
                    "best_rp_postmark" => 106
                ],
                "3YO TURF" => [
                    "group_name" => "3YO TURF",
                    "races_number" => 168,
                    "place_1st_number" => 11,
                    "place_2nd_number" => 23,
                    "place_3rd_number" => 22,
                    "place_4th_number" => 26,
                    "win_prize" => 84966.54,
                    "total_prize" => 211491.22,
                    "euro_win_prize" => 99410.22,
                    "euro_total_prize" => 247444.47,
                    "stake" => -94.5,
                    "win_percent" => 7,
                    "horses" => 117,
                    "placed" => 53,
                    "horse_uid" => 855846,
                    "horse_name" => "Tupi",
                    "best_rp_postmark" => 109
                ],
                "4YO+ AW" => [
                    "group_name" => "4YO+ AW",
                    "races_number" => 23,
                    "place_1st_number" => 1,
                    "place_2nd_number" => 5,
                    "place_3rd_number" => 1,
                    "place_4th_number" => 3,
                    "win_prize" => 3234.5,
                    "total_prize" => 11291.84,
                    "euro_win_prize" => 3783.78,
                    "euro_total_prize" => 13210.47,
                    "stake" => -21.75,
                    "win_percent" => 4,
                    "horses" => 17,
                    "placed" => 7,
                    "horse_uid" => 788804,
                    "horse_name" => "Niceofyoutotellme",
                    "best_rp_postmark" => 105
                ],
                "4YO+ TURF" => [
                    "group_name" => "4YO+ TURF",
                    "races_number" => 114,
                    "place_1st_number" => 19,
                    "place_2nd_number" => 8,
                    "place_3rd_number" => 16,
                    "place_4th_number" => 7,
                    "win_prize" => 391043.32,
                    "total_prize" => 502804.32,
                    "euro_win_prize" => 457520.31,
                    "euro_total_prize" => 588280.68,
                    "stake" => 19.93,
                    "win_percent" => 17,
                    "horses" => 72,
                    "placed" => 40,
                    "horse_uid" => 819428,
                    "horse_name" => "Pether's Moon",
                    "best_rp_postmark" => 120
                ]
            ],
            '____86592' => [
                "CHASE" => [
                    "group_name" => "CHASE",
                    "races_number" => 789,
                    "place_1st_number" => 149,
                    "place_2nd_number" => 131,
                    "place_3rd_number" => 110,
                    "place_4th_number" => 86,
                    "win_prize" => 1738678.29,
                    "total_prize" => 2692271.12,
                    "euro_win_prize" => 2034253.26,
                    "euro_total_prize" => 3149957.07,
                    "stake" => -58.34,
                    "win_percent" => 19,
                    "horses" => 306,
                    "placed" => 319,
                    "horse_uid" => 820273,
                    "horse_name" => "Ptit Zig",
                    "best_rp_postmark" => 170
                ],
                "HURDLE" => [
                    "group_name" => "HURDLE",
                    "races_number" => 1016,
                    "place_1st_number" => 160,
                    "place_2nd_number" => 149,
                    "place_3rd_number" => 121,
                    "place_4th_number" => 120,
                    "win_prize" => 1339982.74,
                    "total_prize" => 2090340,
                    "stake" => -311.92,
                    "win_percent" => 16,
                    "horses" => 505,
                    "placed" => 392,
                    "horse_uid" => 796950,
                    "horse_name" => "The New One",
                    "best_rp_postmark" => 171
                ],
                "NHF" => [
                    "group_name" => "NHF",
                    "races_number" => 155,
                    "place_1st_number" => 25,
                    "place_2nd_number" => 21,
                    "place_3rd_number" => 15,
                    "place_4th_number" => 20,
                    "win_prize" => 76975.82,
                    "total_prize" => 103270.65,
                    "euro_win_prize" => 90060.75,
                    "euro_total_prize" => 120825.9,
                    "stake" => -20.87,
                    "win_percent" => 16,
                    "horses" => 114,
                    "placed" => 56,
                    "horse_uid" => 901912,
                    "horse_name" => "Ballyandy",
                    "best_rp_postmark" => 134
                ]
            ]
        ];
        return $data[$key];
    }
}
