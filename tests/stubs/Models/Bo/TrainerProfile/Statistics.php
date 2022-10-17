<?php

namespace Tests\Stubs\Models\Bo\TrainerProfile;

use Phalcon\Mvc\Model as Model;
use Phalcon\Mvc\Model\Exception as Exception;
use Tests\Stubs\Models\StubDataGetter;

class Statistics extends \Tests\Stubs\Models\Statistics
{
    use StubDataGetter;

    private static $data;

    /**
     * @return mixed
     */
    public function getStatistics(\Api\Input\Request\HorsesRequest $request, \Models\Selectors $selectors)
    {
        if (empty(self::$data)) {
            $this->init();
        }
        return self::$data[self::getRequestKey($request)];
    }

    private function init()
    {
        self::$data =
            [
                '2014_2015_GB_flat_jockey__14006' => [
                    'OVERALL' => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 78224,
                                'group_name' => 'George Baker',
                                'rides' => 2,
                                'wins' => 1,
                                'stake' => '24.00000000000000',
                                'total_prize' => 4851.75,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 1,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 76875,
                                'group_name' => 'Mr D H Dunsdon',
                                'rides' => 6,
                                'wins' => 1,
                                'stake' => '7.00000000000000',
                                'total_prize' => 3820.5799999999999,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 0,
                                'placed' => 1,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 87349,
                                'group_name' => 'Andrea Atzeni',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 699,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 92152,
                                'group_name' => 'Jordan Vaughan',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 384.80000000000001,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 79244,
                                'group_name' => 'Sam Hitchcott',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 7458,
                                'group_name' => 'Franny Norton',
                                'rides' => 2,
                                'wins' => 0,
                                'stake' => '-2.00000000000000',
                                'total_prize' => 1202.5,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 1,
                                'placed' => 0,
                            ]
                        ),
                    ],
                    '4YO+' => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => '4YO+',
                                'group_id' => 78224,
                                'group_name' => 'George Baker',
                                'rides' => 2,
                                'wins' => 1,
                                'stake' => '24.00000000000000',
                                'total_prize' => 4851.75,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 1,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => '4YO+',
                                'group_id' => 76875,
                                'group_name' => 'Mr D H Dunsdon',
                                'rides' => 6,
                                'wins' => 1,
                                'stake' => '7.00000000000000',
                                'total_prize' => 3820.5799999999999,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 0,
                                'placed' => 1,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => '4YO+',
                                'group_id' => 87349,
                                'group_name' => 'Andrea Atzeni',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 699,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => '4YO+',
                                'group_id' => 92152,
                                'group_name' => 'Jordan Vaughan',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 384.80000000000001,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => '4YO+',
                                'group_id' => 79244,
                                'group_name' => 'Sam Hitchcott',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => '4YO+',
                                'group_id' => 7458,
                                'group_name' => 'Franny Norton',
                                'rides' => 2,
                                'wins' => 0,
                                'stake' => '-2.00000000000000',
                                'total_prize' => 1202.5,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 1,
                                'placed' => 0,
                            ]
                        ),
                    ],
                ],
                '2014_2015_IRE_jumps_race-type__14006' => [
                    'OVERALL' => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_name' => 'Handicap',
                                'wins' => 0,
                                'rides' => 1,
                                'stake' => -1,
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                    ],
                    'CHASE' => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'CHASE',
                                'group_name' => 'Handicap',
                                'wins' => 0,
                                'rides' => 1,
                                'stake' => -1,
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                    ],
                ],
                '2013_2014_GB_flat_distance_turf_14006' => [
                    'OVERALL' => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'stats_type' => 'distance',
                                'category' => 'OVERALL',
                                'group_name' => 5,
                                'rides' => 2,
                                'wins' => 0,
                                'stake' => '-2.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 1,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'stats_type' => 'distance',
                                'category' => 'OVERALL',
                                'group_name' => 6,
                                'rides' => 6,
                                'wins' => 1,
                                'stake' => '20.00000000000000',
                                'total_prize' => 6127.9499999999998,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 1,
                                'placed' => 1,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'stats_type' => 'distance',
                                'category' => 'OVERALL',
                                'group_name' => 7,
                                'rides' => 2,
                                'wins' => 0,
                                'stake' => '-2.00000000000000',
                                'total_prize' => 1202.5,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 1,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'stats_type' => 'distance',
                                'category' => 'OVERALL',
                                'group_name' => 8,
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                    ],
                    '4YO+' => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'stats_type' => 'distance',
                                'category' => '4YO+',
                                'group_name' => 5,
                                'rides' => 2,
                                'wins' => 0,
                                'stake' => '-2.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 1,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'stats_type' => 'distance',
                                'category' => '4YO+',
                                'group_name' => 6,
                                'rides' => 6,
                                'wins' => 1,
                                'stake' => '20.00000000000000',
                                'total_prize' => 6127.9499999999998,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 1,
                                'placed' => 1,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'stats_type' => 'distance',
                                'category' => '4YO+',
                                'group_name' => 7,
                                'rides' => 2,
                                'wins' => 0,
                                'stake' => '-2.00000000000000',
                                'total_prize' => 1202.5,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 1,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'stats_type' => 'distance',
                                'category' => '4YO+',
                                'group_name' => 8,
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                    ],
                ],
                '14006' => [
                    'OVERALL' => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 2,
                                'group_name' => 'Ascot',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 2385,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 11,
                                'group_name' => 'Cheltenham',
                                'rides' => 2,
                                'wins' => 0,
                                'stake' => '-2.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 12,
                                'group_name' => 'Chepstow',
                                'rides' => 2,
                                'wins' => 0,
                                'stake' => '-2.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 15,
                                'group_name' => 'Doncaster',
                                'rides' => 2,
                                'wins' => 0,
                                'stake' => '-2.00000000000000',
                                'total_prize' => 2370,
                                'place_2nd_number' => 1,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 1,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 20,
                                'group_name' => 'Fontwell',
                                'rides' => 9,
                                'wins' => 2,
                                'stake' => '13.00000000000000',
                                'total_prize' => 9383.3999999999996,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 2,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 26,
                                'group_name' => 'Huntingdon',
                                'rides' => 4,
                                'wins' => 0,
                                'stake' => '-4.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 28,
                                'group_name' => 'Kempton',
                                'rides' => 3,
                                'wins' => 0,
                                'stake' => '-3.00000000000000',
                                'total_prize' => 572.39999999999998,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 0,
                                'placed' => 1,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 35,
                                'group_name' => 'Market Rasen',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 36,
                                'group_name' => 'Newbury',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 44,
                                'group_name' => 'Plumpton',
                                'rides' => 8,
                                'wins' => 2,
                                'stake' => '-4.83600000000000',
                                'total_prize' => 9461.25,
                                'place_2nd_number' => 1,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 1,
                                'placed' => 2,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 54,
                                'group_name' => 'Sandown',
                                'rides' => 2,
                                'wins' => 0,
                                'stake' => '-2.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 67,
                                'group_name' => 'Stratford',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 83,
                                'group_name' => 'Towcester',
                                'rides' => 4,
                                'wins' => 0,
                                'stake' => '-4.00000000000000',
                                'total_prize' => 667.79999999999995,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 0,
                                'placed' => 1,
                            ]
                        ),
                    ],
                    'CHASE' => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'CHASE',
                                'group_id' => 2,
                                'group_name' => 'Ascot',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 2385,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'CHASE',
                                'group_id' => 11,
                                'group_name' => 'Cheltenham',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'CHASE',
                                'group_id' => 12,
                                'group_name' => 'Chepstow',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'CHASE',
                                'group_id' => 15,
                                'group_name' => 'Doncaster',
                                'rides' => 2,
                                'wins' => 0,
                                'stake' => '-2.00000000000000',
                                'total_prize' => 2370,
                                'place_2nd_number' => 1,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 1,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'CHASE',
                                'group_id' => 20,
                                'group_name' => 'Fontwell',
                                'rides' => 3,
                                'wins' => 1,
                                'stake' => '8.00000000000000',
                                'total_prize' => 2885.4000000000001,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 1,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'CHASE',
                                'group_id' => 26,
                                'group_name' => 'Huntingdon',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'CHASE',
                                'group_id' => 35,
                                'group_name' => 'Market Rasen',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'CHASE',
                                'group_id' => 44,
                                'group_name' => 'Plumpton',
                                'rides' => 4,
                                'wins' => 0,
                                'stake' => '-4.00000000000000',
                                'total_prize' => 2194.1999999999998,
                                'place_2nd_number' => 1,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'CHASE',
                                'group_id' => 54,
                                'group_name' => 'Sandown',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'CHASE',
                                'group_id' => 67,
                                'group_name' => 'Stratford',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'CHASE',
                                'group_id' => 83,
                                'group_name' => 'Towcester',
                                'rides' => 3,
                                'wins' => 0,
                                'stake' => '-3.00000000000000',
                                'total_prize' => 667.79999999999995,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 0,
                                'placed' => 1,
                            ]
                        ),
                    ],
                    'HURDLE' => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'HURDLE',
                                'group_id' => 11,
                                'group_name' => 'Cheltenham',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'HURDLE',
                                'group_id' => 12,
                                'group_name' => 'Chepstow',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'HURDLE',
                                'group_id' => 20,
                                'group_name' => 'Fontwell',
                                'rides' => 4,
                                'wins' => 1,
                                'stake' => '7.00000000000000',
                                'total_prize' => 6498,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 1,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'HURDLE',
                                'group_id' => 26,
                                'group_name' => 'Huntingdon',
                                'rides' => 3,
                                'wins' => 0,
                                'stake' => '-3.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'HURDLE',
                                'group_id' => 28,
                                'group_name' => 'Kempton',
                                'rides' => 3,
                                'wins' => 0,
                                'stake' => '-3.00000000000000',
                                'total_prize' => 572.39999999999998,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 0,
                                'placed' => 1,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'HURDLE',
                                'group_id' => 36,
                                'group_name' => 'Newbury',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'HURDLE',
                                'group_id' => 44,
                                'group_name' => 'Plumpton',
                                'rides' => 3,
                                'wins' => 2,
                                'stake' => '0.16400000000000',
                                'total_prize' => 7147.8000000000002,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 2,
                            ]
                        ),
                    ],
                    'NHF' => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'NHF',
                                'group_id' => 20,
                                'group_name' => 'Fontwell',
                                'rides' => 2,
                                'wins' => 0,
                                'stake' => '-2.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'NHF',
                                'group_id' => 44,
                                'group_name' => 'Plumpton',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 119.25,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 1,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'NHF',
                                'group_id' => 54,
                                'group_name' => 'Sandown',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'NHF',
                                'group_id' => 83,
                                'group_name' => 'Towcester',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                    ],
                ],
                '2014_2015_IRE_flat_race-type_aw_championship_1132' => [
                    "OVERALL" => [
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "Apprentice",
                            "rides" => 17,
                            "wins" => 1,
                            "percent" => 6,
                            "stakes" => 4,
                            "total_prize" => 12255,
                            "place_2nd_number" => 4,
                            "place_3rd_number" => 2,
                            "place_4th_number" => 0,
                            "race_placed" => 7
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "Claiming",
                            "rides" => 2,
                            "wins" => 1,
                            "percent" => 50,
                            "stakes" => 1.25,
                            "total_prize" => 5875,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 1,
                            "place_4th_number" => 0,
                            "race_placed" => 2
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "Handicap",
                            "rides" => 112,
                            "wins" => 15,
                            "percent" => 13,
                            "stakes" => -18.38,
                            "total_prize" => 152227.5,
                            "place_2nd_number" => 12,
                            "place_3rd_number" => 9,
                            "place_4th_number" => 7,
                            "race_placed" => 37
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "Listed",
                            "rides" => 6,
                            "wins" => 0,
                            "percent" => 0,
                            "stakes" => -6,
                            "total_prize" => 19150,
                            "place_2nd_number" => 1,
                            "place_3rd_number" => 2,
                            "place_4th_number" => 0,
                            "race_placed" => 3
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "Maiden",
                            "rides" => 61,
                            "wins" => 17,
                            "percent" => 28,
                            "stakes" => -12.89,
                            "total_prize" => 165075,
                            "place_2nd_number" => 11,
                            "place_3rd_number" => 7,
                            "place_4th_number" => 6,
                            "race_placed" => 35
                        ]
                    ],
                    "2YO" => [
                        (Object)[
                            "category" => "2YO",
                            "group_id" => null,
                            "group_name" => "Handicap",
                            "rides" => 2,
                            "wins" => 2,
                            "percent" => 100,
                            "stakes" => 5.75,
                            "total_prize" => 14490,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 2
                        ],
                        (Object)[
                            "category" => "2YO",
                            "group_id" => null,
                            "group_name" => "Listed",
                            "rides" => 1,
                            "wins" => 0,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 1100,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 0
                        ],
                        (Object)[
                            "category" => "2YO",
                            "group_id" => null,
                            "group_name" => "Maiden",
                            "rides" => 32,
                            "wins" => 8,
                            "percent" => 25,
                            "stakes" => -12.95,
                            "total_prize" => 90815,
                            "place_2nd_number" => 7,
                            "place_3rd_number" => 4,
                            "place_4th_number" => 3,
                            "race_placed" => 19
                        ]
                    ],
                    "3YO" => [
                        (Object)[
                            "category" => "3YO",
                            "group_id" => null,
                            "group_name" => "Apprentice",
                            "rides" => 10,
                            "wins" => 1,
                            "percent" => 10,
                            "stakes" => 11,
                            "total_prize" => 9010,
                            "place_2nd_number" => 2,
                            "place_3rd_number" => 1,
                            "place_4th_number" => 0,
                            "race_placed" => 4
                        ],
                        (Object)[
                            "category" => "3YO",
                            "group_id" => null,
                            "group_name" => "Claiming",
                            "rides" => 1,
                            "wins" => 0,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 700,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 1,
                            "place_4th_number" => 0,
                            "race_placed" => 1
                        ],
                        (Object)[
                            "category" => "3YO",
                            "group_id" => null,
                            "group_name" => "Handicap",
                            "rides" => 35,
                            "wins" => 8,
                            "percent" => 23,
                            "stakes" => 26.12,
                            "total_prize" => 69235,
                            "place_2nd_number" => 3,
                            "place_3rd_number" => 2,
                            "place_4th_number" => 3,
                            "race_placed" => 13
                        ],
                        (Object)[
                            "category" => "3YO",
                            "group_id" => null,
                            "group_name" => "Listed",
                            "rides" => 3,
                            "wins" => 0,
                            "percent" => 0,
                            "stakes" => -3,
                            "total_prize" => 13550,
                            "place_2nd_number" => 1,
                            "place_3rd_number" => 1,
                            "place_4th_number" => 0,
                            "race_placed" => 2
                        ],
                        (Object)[
                            "category" => "3YO",
                            "group_id" => null,
                            "group_name" => "Maiden",
                            "rides" => 29,
                            "wins" => 9,
                            "percent" => 31,
                            "stakes" => 0.06,
                            "total_prize" => 74260,
                            "place_2nd_number" => 4,
                            "place_3rd_number" => 3,
                            "place_4th_number" => 3,
                            "race_placed" => 16
                        ]
                    ],
                    "4YO+" => [
                        (Object)[
                            "category" => "4YO+",
                            "group_id" => null,
                            "group_name" => "Apprentice",
                            "rides" => 7,
                            "wins" => 0,
                            "percent" => 0,
                            "stakes" => -7,
                            "total_prize" => 3245,
                            "place_2nd_number" => 2,
                            "place_3rd_number" => 1,
                            "place_4th_number" => 0,
                            "race_placed" => 3
                        ],
                        (Object)[
                            "category" => "4YO+",
                            "group_id" => null,
                            "group_name" => "Claiming",
                            "rides" => 1,
                            "wins" => 1,
                            "percent" => 100,
                            "stakes" => 2.25,
                            "total_prize" => 5175,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 1
                        ],
                        (Object)[
                            "category" => "4YO+",
                            "group_id" => null,
                            "group_name" => "Handicap",
                            "rides" => 75,
                            "wins" => 5,
                            "percent" => 7,
                            "stakes" => -50.25,
                            "total_prize" => 68502.5,
                            "place_2nd_number" => 9,
                            "place_3rd_number" => 7,
                            "place_4th_number" => 4,
                            "race_placed" => 22
                        ],
                        (Object)[
                            "category" => "4YO+",
                            "group_id" => null,
                            "group_name" => "Listed",
                            "rides" => 2,
                            "wins" => 0,
                            "percent" => 0,
                            "stakes" => -2,
                            "total_prize" => 4500,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 1,
                            "place_4th_number" => 0,
                            "race_placed" => 1
                        ]
                    ]
                ]
            ];
    }
}
