<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 9/22/2016
 * Time: 3:39 PM
 */

namespace Tests\Stubs\Models\Bo\RecordByRaceType;

class TrainerProfile extends \Models\Bo\RecordByRaceType\TrainerProfile
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
            'GB_flat_2011_2012_4431' => [
                '2YO AW' => \Api\Row\TrainerProfile\RecordByRaceType::createFromArray(
                    [
                        'group_name' => '2YO AW',
                        'best_rp_postmark' => 82,
                        'best_horse_uid' => 784560,
                        'best_horse_name' => 'Pint Size',
                        'placed' => 7,
                        'horses' => 7,
                        'winners' => 3,
                        'races_number' => 12,
                        'place_1st_number' => 3,
                        'place_2nd_number' => 2,
                        'place_3rd_number' => 2,
                        'place_4th_number' => 3,
                        'win_prize' => 8045.6199999999999,
                        'total_prize' => 11343.66,
                        'euro_win_prize' => 0,
                        'euro_total_prize' => 0,
                        'stake' => '-0.33300000000000',
                    ]
                ),
                '2YO TURF' => \Api\Row\TrainerProfile\RecordByRaceType::createFromArray(
                    [
                        'group_name' => '2YO TURF',
                        'best_rp_postmark' => 76,
                        'best_horse_uid' => 785161,
                        'best_horse_name' => 'Travis County',
                        'placed' => 5,
                        'horses' => 10,
                        'winners' => 2,
                        'races_number' => 28,
                        'place_1st_number' => 2,
                        'place_2nd_number' => 1,
                        'place_3rd_number' => 4,
                        'place_4th_number' => 1,
                        'win_prize' => 6796.3000000000002,
                        'total_prize' => 10915.16,
                        'euro_win_prize' => 0,
                        'euro_total_prize' => 0,
                        'stake' => '-16.25000000000000',
                    ]
                ),
                '3YO AW' => \Api\Row\TrainerProfile\RecordByRaceType::createFromArray(
                    [
                        'group_name' => '3YO AW',
                        'best_rp_postmark' => 85,
                        'best_horse_uid' => 790936,
                        'best_horse_name' => 'Alaskan Bullet',
                        'placed' => 16,
                        'horses' => 18,
                        'winners' => 7,
                        'races_number' => 59,
                        'place_1st_number' => 7,
                        'place_2nd_number' => 4,
                        'place_3rd_number' => 10,
                        'place_4th_number' => 8,
                        'win_prize' => 13733.700000000001,
                        'total_prize' => 21065.990000000002,
                        'euro_win_prize' => 0,
                        'euro_total_prize' => 0,
                        'stake' => '-12.98300000000000',
                    ]
                ),
                '3YO TURF' => \Api\Row\TrainerProfile\RecordByRaceType::createFromArray(
                    [
                        'group_name' => '3YO TURF',
                        'best_rp_postmark' => 82,
                        'best_horse_uid' => 762737,
                        'best_horse_name' => 'Certral',
                        'placed' => 14,
                        'horses' => 20,
                        'winners' => 4,
                        'races_number' => 60,
                        'place_1st_number' => 5,
                        'place_2nd_number' => 5,
                        'place_3rd_number' => 5,
                        'place_4th_number' => 10,
                        'win_prize' => 10888.25,
                        'total_prize' => 19907.369999999999,
                        'euro_win_prize' => 0,
                        'euro_total_prize' => 0,
                        'stake' => '-40.00000000000000',
                    ]
                ),
                '4YO+ AW' => \Api\Row\TrainerProfile\RecordByRaceType::createFromArray(
                    [
                        'group_name' => '4YO+ AW',
                        'best_rp_postmark' => 95,
                        'best_horse_uid' => 745007,
                        'best_horse_name' => 'Tappanappa',
                        'placed' => 98,
                        'horses' => 76,
                        'winners' => 27,
                        'races_number' => 226,
                        'place_1st_number' => 42,
                        'place_2nd_number' => 43,
                        'place_3rd_number' => 21,
                        'place_4th_number' => 21,
                        'win_prize' => 80427.149999999994,
                        'total_prize' => 115731.77,
                        'euro_win_prize' => 0,
                        'euro_total_prize' => 0,
                        'stake' => '-56.72100000000000',
                    ]
                ),
                '4YO+ TURF' => \Api\Row\TrainerProfile\RecordByRaceType::createFromArray(
                    [
                        'group_name' => '4YO+ TURF',
                        'best_rp_postmark' => 113,
                        'best_horse_uid' => 695715,
                        'best_horse_name' => 'Saptapadi',
                        'placed' => 143,
                        'horses' => 77,
                        'winners' => 36,
                        'races_number' => 428,
                        'place_1st_number' => 55,
                        'place_2nd_number' => 44,
                        'place_3rd_number' => 35,
                        'place_4th_number' => 39,
                        'win_prize' => 393543.97999999998,
                        'total_prize' => 547649.65000000002,
                        'euro_win_prize' => 0,
                        'euro_total_prize' => 0,
                        'stake' => '-12.80200000000000',
                    ]
                ),
            ],
            'GB_jumps_2011_2012_4431' => [
                'CHASE' => \Api\Row\TrainerProfile\RecordByRaceType::createFromArray(
                    [
                        'group_name' => 'CHASE',
                        'best_rp_postmark' => 144,
                        'best_horse_uid' => 440428,
                        'best_horse_name' => 'Ultimate',
                        'placed' => 37,
                        'horses' => 19,
                        'winners' => 7,
                        'races_number' => 91,
                        'place_1st_number' => 20,
                        'place_2nd_number' => 13,
                        'place_3rd_number' => 10,
                        'place_4th_number' => 11,
                        'win_prize' => 152747.04999999999,
                        'total_prize' => 201556.88,
                        'euro_win_prize' => 0,
                        'euro_total_prize' => 0,
                        'stake' => '6.66700000000000',
                    ]
                ),
                'HURDLE' => \Api\Row\TrainerProfile\RecordByRaceType::createFromArray(
                    [
                        'group_name' => 'HURDLE',
                        'best_rp_postmark' => 149,
                        'best_horse_uid' => 735941,
                        'best_horse_name' => 'Marsh Warbler',
                        'placed' => 163,
                        'horses' => 87,
                        'winners' => 17,
                        'races_number' => 378,
                        'place_1st_number' => 55,
                        'place_2nd_number' => 61,
                        'place_3rd_number' => 55,
                        'place_4th_number' => 36,
                        'win_prize' => 276525.46999999997,
                        'total_prize' => 456467.89000000001,
                        'euro_win_prize' => 0,
                        'euro_total_prize' => 0,
                        'stake' => '-57.78900000000000',
                    ]
                ),
                'NHF' => \Api\Row\TrainerProfile\RecordByRaceType::createFromArray(
                    [
                        'group_name' => 'NHF',
                        'best_rp_postmark' => 136,
                        'best_horse_uid' => 750380,
                        'best_horse_name' => 'Abergavenny',
                        'placed' => 8,
                        'horses' => 22,
                        'winners' => 1,
                        'races_number' => 35,
                        'place_1st_number' => 2,
                        'place_2nd_number' => 3,
                        'place_3rd_number' => 6,
                        'place_4th_number' => 3,
                        'win_prize' => 6713.6999999999998,
                        'total_prize' => 12332.040000000001,
                        'euro_win_prize' => 0,
                        'euro_total_prize' => 0,
                        'stake' => '-17.50000000000000',
                    ]
                ),
            ]
        ];

        return $data[$key];
    }
}
