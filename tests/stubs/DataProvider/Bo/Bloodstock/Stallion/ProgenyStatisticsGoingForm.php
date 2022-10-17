<?php
namespace Tests\Stubs\DataProvider\Bo\Bloodstock\Stallion;

class ProgenyStatisticsGoingForm extends \Api\DataProvider\Bo\Bloodstock\Stallion\ProgenyStatisticsGoingForm
{
    /**
     * @param \Api\Input\Request\Horses\Bloodstock\Stallion\ProgenyStatisticsGoingForm $request
     *
     * @return \Phalcon\Mvc\Model\Row\General[]
     */
    public function getGoingForm(\Api\Input\Request\Horses\Bloodstock\Stallion\ProgenyStatisticsGoingForm $request)
    {
        $data = [
            531769 => [
                'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'going_group' => "good_to_firm",
                        'wins' => 331,
                        'runs' => 1999,
                        'win_percentage' => 17,
                        'impact_value' => null,
                    ]
                ),
                'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'going_group' => "good",
                        'wins' => 530,
                        'runs' => 3473,
                        'win_percentage' => 15,
                        'impact_value' => null,
                    ]
                ),
                'good_to_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'going_group' => "good_to_soft",
                        'wins' => 230,
                        'runs' => 1491,
                        'win_percentage' => 15,
                        'impact_value' => null,
                    ]
                ),
                'heavy_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'going_group' => "heavy_soft",
                        'wins' => 462,
                        'runs' => 2910,
                        'win_percentage' => 16,
                        'impact_value' => null,
                    ]
                ),
                'firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'going_group' => "firm",
                        'wins' => 35,
                        'runs' => 199,
                        'win_percentage' => 18,
                        'impact_value' => null,
                    ]
                ),
            ]
        ];

        return empty($data[$request->getStallionId()]) ? null : $data[$request->getStallionId()];
    }

    /**
     * @param array $horseIds
     *
     * @return \Phalcon\Mvc\Model\Row\General[]
     */
    public function getGoingFormBySire(array $horseIds, $prefix)
    {
        $key = implode('_', $horseIds);

        $data = [
            '300048_301831_303465_300101_300106_301341_301528_300363_301663_300625_106681_458175_522793' => [
                '300048' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'sire_uid' => 300048,
                        'going_groups' => [
                            "firm" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "firm",
                                    'wins' => 27,
                                    'runs' => 155,
                                    'win_percentage' => 17,
                                    'impact_value' => null
                                ]
                            ),
                            'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good",
                                    'wins' => 183,
                                    'runs' => 1031,
                                    'win_percentage' => 18,
                                    'impact_value' => null
                                ]
                            ),
                            'good_to_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good_to_soft",
                                    'wins' => 73,
                                    'runs' => 446,
                                    'win_percentage' => 16,
                                    'impact_value' => null
                                ]
                            ),
                            'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good_to_firm",
                                    'wins' => 92,
                                    'runs' => 634,
                                    'win_percentage' => 15,
                                    'impact_value' => null
                                ]
                            ),
                            'heavy_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "heavy_soft",
                                    'wins' => 115,
                                    'runs' => 772,
                                    'win_percentage' => 15,
                                    'impact_value' => null
                                ]
                            ),
                        ],
                    ]
                ),
                '301831' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'sire_uid' => 301831,
                        'going_groups' => [
                            "firm" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "firm",
                                    'wins' => 118,
                                    'runs' => 672,
                                    'win_percentage' => 18,
                                    'impact_value' => null
                                ]
                            ),
                            'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good_to_firm",
                                    'wins' => 256,
                                    'runs' => 1924,
                                    'win_percentage' => 13,
                                    'impact_value' => null
                                ]
                            ),
                            'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good",
                                    'wins' => 265,
                                    'runs' => 2251,
                                    'win_percentage' => 12,
                                    'impact_value' => null
                                ]
                            ),
                            'good_to_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good_to_soft",
                                    'wins' => 95,
                                    'runs' => 968,
                                    'win_percentage' => 10,
                                    'impact_value' => null
                                ]
                            ),
                            'heavy_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "heavy_soft",
                                    'wins' => 127,
                                    'runs' => 1240,
                                    'win_percentage' => 10,
                                    'impact_value' => null
                                ]
                            ),
                        ],
                    ]
                ),
                '303465' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'sire_uid' => 303465,
                        'going_groups' => [
                            "good_to_soft" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good_to_soft",
                                    'wins' => 91,
                                    'runs' => 874,
                                    'win_percentage' => 10,
                                    'impact_value' => null
                                ]
                            ),
                            'heavy_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "heavy_soft",
                                    'wins' => 249,
                                    'runs' => 2439,
                                    'win_percentage' => 10,
                                    'impact_value' => null
                                ]
                            ),
                            'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good_to_firm",
                                    'wins' => 112,
                                    'runs' => 921,
                                    'win_percentage' => 12,
                                    'impact_value' => null
                                ]
                            ),
                            'firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "firm",
                                    'wins' => 23,
                                    'runs' => 221,
                                    'win_percentage' => 10,
                                    'impact_value' => null
                                ]
                            ),
                            'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good",
                                    'wins' => 204,
                                    'runs' => 1801,
                                    'win_percentage' => 11,
                                    'impact_value' => null
                                ]
                            ),
                        ],
                    ]
                ),
                '300101' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'sire_uid' => 300101,
                        'going_groups' => [
                            "good" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good",
                                    'wins' => 74,
                                    'runs' => 664,
                                    'win_percentage' => 11,
                                    'impact_value' => null
                                ]
                            ),
                            'firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "firm",
                                    'wins' => 27,
                                    'runs' => 163,
                                    'win_percentage' => 17,
                                    'impact_value' => null
                                ]
                            ),
                            'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good_to_firm",
                                    'wins' => 47,
                                    'runs' => 433,
                                    'win_percentage' => 11,
                                    'impact_value' => null
                                ]
                            ),
                            'heavy_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "heavy_soft",
                                    'wins' => 62,
                                    'runs' => 578,
                                    'win_percentage' => 11,
                                    'impact_value' => null
                                ]
                            ),
                            'good_to_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good_to_soft",
                                    'wins' => 33,
                                    'runs' => 255,
                                    'win_percentage' => 13,
                                    'impact_value' => null
                                ]
                            ),
                        ],
                    ]
                ),
                '300106' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'sire_uid' => 300106,
                        'going_groups' => [
                            "good_to_soft" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good_to_soft",
                                    'wins' => 113,
                                    'runs' => 641,
                                    'win_percentage' => 18,
                                    'impact_value' => null
                                ]
                            ),
                            'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good_to_firm",
                                    'wins' => 92,
                                    'runs' => 655,
                                    'win_percentage' => 14,
                                    'impact_value' => null
                                ]
                            ),
                            'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good",
                                    'wins' => 173,
                                    'runs' => 1174,
                                    'win_percentage' => 15,
                                    'impact_value' => null
                                ]
                            ),
                            'firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "firm",
                                    'wins' => 32,
                                    'runs' => 215,
                                    'win_percentage' => 15,
                                    'impact_value' => null
                                ]
                            ),
                            'heavy_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "heavy_soft",
                                    'wins' => 141,
                                    'runs' => 914,
                                    'win_percentage' => 15,
                                    'impact_value' => null
                                ]
                            ),
                        ],
                    ]
                ),
                '301341' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'sire_uid' => 301341,
                        'going_groups' => [
                            "firm" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "firm",
                                    'wins' => 51,
                                    'runs' => 299,
                                    'win_percentage' => 17,
                                    'impact_value' => null
                                ]
                            ),
                            'good_to_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good_to_soft",
                                    'wins' => 51,
                                    'runs' => 529,
                                    'win_percentage' => 10,
                                    'impact_value' => null
                                ]
                            ),
                            'heavy_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "heavy_soft",
                                    'wins' => 80,
                                    'runs' => 714,
                                    'win_percentage' => 11,
                                    'impact_value' => null
                                ]
                            ),
                            'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good",
                                    'wins' => 147,
                                    'runs' => 1132,
                                    'win_percentage' => 13,
                                    'impact_value' => null
                                ]
                            ),
                            'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good_to_firm",
                                    'wins' => 125,
                                    'runs' => 919,
                                    'win_percentage' => 14,
                                    'impact_value' => null
                                ]
                            ),
                        ],
                    ]
                ),
                '301528' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'sire_uid' => 301528,
                        'going_groups' => [
                            "firm" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "firm",
                                    'wins' => 1,
                                    'runs' => 11,
                                    'win_percentage' => 9,
                                    'impact_value' => null
                                ]
                            ),
                            'good_to_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good_to_soft",
                                    'wins' => 1,
                                    'runs' => 13,
                                    'win_percentage' => 8,
                                    'impact_value' => null
                                ]
                            ),
                            'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good_to_firm",
                                    'wins' => 2,
                                    'runs' => 22,
                                    'win_percentage' => 9,
                                    'impact_value' => null
                                ]
                            ),
                            'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good",
                                    'wins' => 2,
                                    'runs' => 37,
                                    'win_percentage' => 5,
                                    'impact_value' => null
                                ]
                            ),
                            'heavy_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "heavy_soft",
                                    'wins' => 4,
                                    'runs' => 22,
                                    'win_percentage' => 18,
                                    'impact_value' => null
                                ]
                            ),
                        ],
                    ]
                ),
                '300363' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'sire_uid' => 300363,
                        'going_groups' => [
                            "good_to_firm" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good_to_firm",
                                    'wins' => 88,
                                    'runs' => 692,
                                    'win_percentage' => 13,
                                    'impact_value' => null
                                ]
                            ),
                            'heavy_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "heavy_soft",
                                    'wins' => 92,
                                    'runs' => 624,
                                    'win_percentage' => 15,
                                    'impact_value' => null
                                ]
                            ),
                            'good_to_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good_to_soft",
                                    'wins' => 75,
                                    'runs' => 537,
                                    'win_percentage' => 14,
                                    'impact_value' => null
                                ]
                            ),
                            'firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "firm",
                                    'wins' => 51,
                                    'runs' => 301,
                                    'win_percentage' => 17,
                                    'impact_value' => null
                                ]
                            ),
                            'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good",
                                    'wins' => 123,
                                    'runs' => 1022,
                                    'win_percentage' => 12,
                                    'impact_value' => null
                                ]
                            ),
                        ],
                    ]
                ),
                '301663' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'sire_uid' => 301663,
                        'going_groups' => [
                            "good_to_soft" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good_to_soft",
                                    'wins' => 134,
                                    'runs' => 1397,
                                    'win_percentage' => 10,
                                    'impact_value' => null
                                ]
                            ),
                            'heavy_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "heavy_soft",
                                    'wins' => 168,
                                    'runs' => 1882,
                                    'win_percentage' => 9,
                                    'impact_value' => null
                                ]
                            ),
                            'firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "firm",
                                    'wins' => 102,
                                    'runs' => 782,
                                    'win_percentage' => 13,
                                    'impact_value' => null
                                ]
                            ),
                            'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good_to_firm",
                                    'wins' => 399,
                                    'runs' => 3728,
                                    'win_percentage' => 11,
                                    'impact_value' => null
                                ]
                            ),
                            'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good",
                                    'wins' => 386,
                                    'runs' => 3563,
                                    'win_percentage' => 11,
                                    'impact_value' => null
                                ]
                            ),
                        ],
                    ]
                ),
                '300625' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'sire_uid' => 300625,
                        'going_groups' => [
                            "good" => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good",
                                    'wins' => 243,
                                    'runs' => 1809,
                                    'win_percentage' => 13,
                                    'impact_value' => null
                                ]
                            ),
                            'good_to_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good_to_soft",
                                    'wins' => 113,
                                    'runs' => 825,
                                    'win_percentage' => 14,
                                    'impact_value' => null
                                ]
                            ),
                            'firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "firm",
                                    'wins' => 65,
                                    'runs' => 349,
                                    'win_percentage' => 19,
                                    'impact_value' => null
                                ]
                            ),
                            'heavy_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "heavy_soft",
                                    'wins' => 129,
                                    'runs' => 1138,
                                    'win_percentage' => 11,
                                    'impact_value' => null
                                ]
                            ),
                            'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => "good_to_firm",
                                    'wins' => 205,
                                    'runs' => 1477,
                                    'win_percentage' => 14,
                                    'impact_value' => null
                                ]
                            ),
                        ],
                    ]
                ),
                '106681' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    array(
                        'sire_uid' => 106681,
                        'going_groups' => array(
                            'heavy_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'heavy_soft',
                                    'wins' => 12,
                                    'runs' => 228,
                                    'win_percentage' => 5,
                                    'impact_value' => null,
                                )
                            ),
                            'firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'firm',
                                    'wins' => 2,
                                    'runs' => 21,
                                    'win_percentage' => 10,
                                    'impact_value' => null,
                                )
                            ),
                            'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good',
                                    'wins' => 18,
                                    'runs' => 208,
                                    'win_percentage' => 9,
                                    'impact_value' => null,
                                )
                            ),
                            'good_to_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good_to_soft',
                                    'wins' => 8,
                                    'runs' => 144,
                                    'win_percentage' => 6,
                                    'impact_value' => null,
                                )
                            ),
                            'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good_to_firm',
                                    'wins' => 10,
                                    'runs' => 79,
                                    'win_percentage' => 13,
                                    'impact_value' => null,
                                )
                            ),
                        ),
                    )
                ),
                '458175' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    array(
                        'sire_uid' => 458175,
                        'going_groups' => array(
                            'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good',
                                    'wins' => 25,
                                    'runs' => 227,
                                    'win_percentage' => 11,
                                    'impact_value' => null,
                                )
                            ),
                            'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good_to_firm',
                                    'wins' => 17,
                                    'runs' => 101,
                                    'win_percentage' => 17,
                                    'impact_value' => null,
                                )
                            ),
                            'good_to_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good_to_soft',
                                    'wins' => 7,
                                    'runs' => 137,
                                    'win_percentage' => 5,
                                    'impact_value' => null,
                                )
                            ),
                            'heavy_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'heavy_soft',
                                    'wins' => 23,
                                    'runs' => 223,
                                    'win_percentage' => 10,
                                    'impact_value' => null,
                                )
                            ),
                            'firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'firm',
                                    'wins' => 0,
                                    'runs' => 13,
                                    'win_percentage' => 0,
                                    'impact_value' => null,
                                )
                            ),
                        ),
                    )
                ),
                '522793' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    array(
                        'sire_uid' => 522793,
                        'going_groups' => array(
                            'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good',
                                    'wins' => 91,
                                    'runs' => 934,
                                    'win_percentage' => 10,
                                    'impact_value' => null,
                                )
                            ),
                            'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good_to_firm',
                                    'wins' => 28,
                                    'runs' => 331,
                                    'win_percentage' => 8,
                                    'impact_value' => null,
                                )
                            ),
                            'good_to_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good_to_soft',
                                    'wins' => 34,
                                    'runs' => 433,
                                    'win_percentage' => 8,
                                    'impact_value' => null,
                                )
                            ),
                            'firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'firm',
                                    'wins' => 1,
                                    'runs' => 25,
                                    'win_percentage' => 4,
                                    'impact_value' => null,
                                )
                            ),
                            'heavy_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'heavy_soft',
                                    'wins' => 108,
                                    'runs' => 1128,
                                    'win_percentage' => 10,
                                    'impact_value' => null,
                                )
                            ),
                        ),
                    )
                ),
            ],
            '919889_928591_803906_902730_934021_883895_1284539' => array(
                522793 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'sire_uid' => 522793,
                        'going_groups' => [
                            'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => 'good_to_firm',
                                    'wins' => 28,
                                    'runs' => 332,
                                    'sire_going_runs' => 332,
                                    'sire_going_wins' => 28,
                                    'win_percentage' => 8,
                                    'impact_value' => null,
                                ]
                            ),
                            'good_to_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => 'good_to_soft',
                                    'wins' => 34,
                                    'runs' => 437,
                                    'sire_going_runs' => 437,
                                    'sire_going_wins' => 34,
                                    'win_percentage' => 8,
                                    'impact_value' => null,
                                ]
                            ),
                            'heavy' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => 'heavy',
                                    'wins' => 34,
                                    'runs' => 452,
                                    'sire_going_runs' => 452,
                                    'sire_going_wins' => 34,
                                    'win_percentage' => 8,
                                    'impact_value' => null,
                                ]
                            ),
                            'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => 'good',
                                    'wins' => 91,
                                    'runs' => 937,
                                    'sire_going_runs' => 937,
                                    'sire_going_wins' => 91,
                                    'win_percentage' => 10,
                                    'impact_value' => null,
                                ]
                            ),
                            'firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => 'firm',
                                    'wins' => 1,
                                    'runs' => 25,
                                    'sire_going_runs' => 25,
                                    'sire_going_wins' => 1,
                                    'win_percentage' => 4,
                                    'impact_value' => null,
                                ]
                            ),
                            'soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'going_group' => 'soft',
                                    'wins' => 75,
                                    'runs' => 687,
                                    'sire_going_runs' => 687,
                                    'sire_going_wins' => 75,
                                    'win_percentage' => 11,
                                    'impact_value' => null,
                                ]
                            ),
                        ],
                    ]
                ),
                84432 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    array(
                        'sire_uid' => 84432,
                        'going_groups' => array(
                            'soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'soft',
                                    'wins' => 438,
                                    'runs' => 3052,
                                    'sire_going_runs' => 3052,
                                    'sire_going_wins' => 438,
                                    'win_percentage' => 14,
                                    'impact_value' => null,
                                )
                            ),
                            'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good_to_firm',
                                    'wins' => 198,
                                    'runs' => 1378,
                                    'sire_going_runs' => 1378,
                                    'sire_going_wins' => 198,
                                    'win_percentage' => 14,
                                    'impact_value' => null,
                                )
                            ),
                            'firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'firm',
                                    'wins' => 21,
                                    'runs' => 191,
                                    'sire_going_runs' => 191,
                                    'sire_going_wins' => 21,
                                    'win_percentage' => 11,
                                    'impact_value' => null,
                                )
                            ),
                            'heavy' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'heavy',
                                    'wins' => 233,
                                    'runs' => 1671,
                                    'sire_going_runs' => 1671,
                                    'sire_going_wins' => 233,
                                    'win_percentage' => 14,
                                    'impact_value' => null,
                                )
                            ),
                            'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good',
                                    'wins' => 552,
                                    'runs' => 3942,
                                    'sire_going_runs' => 3942,
                                    'sire_going_wins' => 552,
                                    'win_percentage' => 14,
                                    'impact_value' => null,
                                )
                            ),
                            'good_to_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good_to_soft',
                                    'wins' => 361,
                                    'runs' => 2174,
                                    'sire_going_runs' => 2174,
                                    'sire_going_wins' => 361,
                                    'win_percentage' => 17,
                                    'impact_value' => null,
                                )
                            ),
                        ),
                    )
                ),
                458175 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    array(
                        'sire_uid' => 458175,
                        'going_groups' => array(
                            'firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'firm',
                                    'wins' => 0,
                                    'runs' => 13,
                                    'sire_going_runs' => 13,
                                    'sire_going_wins' => 0,
                                    'win_percentage' => 0,
                                    'impact_value' => null,
                                )
                            ),
                            'good_to_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good_to_soft',
                                    'wins' => 7,
                                    'runs' => 137,
                                    'sire_going_runs' => 137,
                                    'sire_going_wins' => 7,
                                    'win_percentage' => 5,
                                    'impact_value' => null,
                                )
                            ),
                            'heavy' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'heavy',
                                    'wins' => 10,
                                    'runs' => 86,
                                    'sire_going_runs' => 86,
                                    'sire_going_wins' => 10,
                                    'win_percentage' => 12,
                                    'impact_value' => null,
                                )
                            ),
                            'soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'soft',
                                    'wins' => 13,
                                    'runs' => 142,
                                    'sire_going_runs' => 142,
                                    'sire_going_wins' => 13,
                                    'win_percentage' => 9,
                                    'impact_value' => null,
                                )
                            ),
                            'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good_to_firm',
                                    'wins' => 17,
                                    'runs' => 101,
                                    'sire_going_runs' => 101,
                                    'sire_going_wins' => 17,
                                    'win_percentage' => 17,
                                    'impact_value' => null,
                                )
                            ),
                            'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good',
                                    'wins' => 25,
                                    'runs' => 228,
                                    'sire_going_runs' => 228,
                                    'sire_going_wins' => 25,
                                    'win_percentage' => 11,
                                    'impact_value' => null,
                                )
                            ),
                        ),
                    )
                ),
                565327 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    array(
                        'sire_uid' => 565327,
                        'going_groups' => array(
                            'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good_to_firm',
                                    'wins' => 18,
                                    'runs' => 188,
                                    'sire_going_runs' => 188,
                                    'sire_going_wins' => 18,
                                    'win_percentage' => 10,
                                    'impact_value' => null,
                                )
                            ),
                            'soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'soft',
                                    'wins' => 79,
                                    'runs' => 754,
                                    'sire_going_runs' => 754,
                                    'sire_going_wins' => 79,
                                    'win_percentage' => 10,
                                    'impact_value' => null,
                                )
                            ),
                            'good_to_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good_to_soft',
                                    'wins' => 56,
                                    'runs' => 471,
                                    'sire_going_runs' => 471,
                                    'sire_going_wins' => 56,
                                    'win_percentage' => 12,
                                    'impact_value' => null,
                                )
                            ),
                            'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good',
                                    'wins' => 113,
                                    'runs' => 929,
                                    'sire_going_runs' => 929,
                                    'sire_going_wins' => 113,
                                    'win_percentage' => 12,
                                    'impact_value' => null,
                                )
                            ),
                            'heavy' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'heavy',
                                    'wins' => 65,
                                    'runs' => 498,
                                    'sire_going_runs' => 498,
                                    'sire_going_wins' => 65,
                                    'win_percentage' => 13,
                                    'impact_value' => null,
                                )
                            ),
                            'firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'firm',
                                    'wins' => 1,
                                    'runs' => 8,
                                    'sire_going_runs' => 8,
                                    'sire_going_wins' => 1,
                                    'win_percentage' => 13,
                                    'impact_value' => null,
                                )
                            ),
                        ),
                    )
                ),
                539937 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    array(
                        'sire_uid' => 539937,
                        'going_groups' => array(
                            'good_to_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good_to_soft',
                                    'wins' => 18,
                                    'runs' => 172,
                                    'sire_going_runs' => 172,
                                    'sire_going_wins' => 18,
                                    'win_percentage' => 10,
                                    'impact_value' => null,
                                )
                            ),
                            'firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'firm',
                                    'wins' => 0,
                                    'runs' => 4,
                                    'sire_going_runs' => 4,
                                    'sire_going_wins' => 0,
                                    'win_percentage' => 0,
                                    'impact_value' => null,
                                )
                            ),
                            'soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'soft',
                                    'wins' => 28,
                                    'runs' => 358,
                                    'sire_going_runs' => 358,
                                    'sire_going_wins' => 28,
                                    'win_percentage' => 8,
                                    'impact_value' => null,
                                )
                            ),
                            'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good',
                                    'wins' => 34,
                                    'runs' => 366,
                                    'sire_going_runs' => 366,
                                    'sire_going_wins' => 34,
                                    'win_percentage' => 9,
                                    'impact_value' => null,
                                )
                            ),
                            'heavy' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'heavy',
                                    'wins' => 18,
                                    'runs' => 229,
                                    'sire_going_runs' => 229,
                                    'sire_going_wins' => 18,
                                    'win_percentage' => 8,
                                    'impact_value' => null,
                                )
                            ),
                            'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good_to_firm',
                                    'wins' => 3,
                                    'runs' => 64,
                                    'sire_going_runs' => 64,
                                    'sire_going_wins' => 3,
                                    'win_percentage' => 5,
                                    'impact_value' => null,
                                )
                            ),
                        ),
                    )
                ),
                106681 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    array(
                        'sire_uid' => 106681,
                        'going_groups' => array(
                            'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good_to_firm',
                                    'wins' => 10,
                                    'runs' => 80,
                                    'sire_going_runs' => 80,
                                    'sire_going_wins' => 10,
                                    'win_percentage' => 13,
                                    'impact_value' => null,
                                )
                            ),
                            'good_to_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good_to_soft',
                                    'wins' => 8,
                                    'runs' => 144,
                                    'sire_going_runs' => 144,
                                    'sire_going_wins' => 8,
                                    'win_percentage' => 6,
                                    'impact_value' => null,
                                )
                            ),
                            'soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'soft',
                                    'wins' => 5,
                                    'runs' => 141,
                                    'sire_going_runs' => 141,
                                    'sire_going_wins' => 5,
                                    'win_percentage' => 4,
                                    'impact_value' => null,
                                )
                            ),
                            'firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'firm',
                                    'wins' => 2,
                                    'runs' => 21,
                                    'sire_going_runs' => 21,
                                    'sire_going_wins' => 2,
                                    'win_percentage' => 10,
                                    'impact_value' => null,
                                )
                            ),
                            'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good',
                                    'wins' => 18,
                                    'runs' => 208,
                                    'sire_going_runs' => 208,
                                    'sire_going_wins' => 18,
                                    'win_percentage' => 9,
                                    'impact_value' => null,
                                )
                            ),
                            'heavy' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'heavy',
                                    'wins' => 7,
                                    'runs' => 87,
                                    'sire_going_runs' => 87,
                                    'sire_going_wins' => 7,
                                    'win_percentage' => 8,
                                    'impact_value' => null,
                                )
                            ),
                        ),
                    )
                ),
                21792 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    array(
                        'sire_uid' => 21792,
                        'going_groups' => array(
                            'heavy' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'heavy',
                                    'wins' => 137,
                                    'runs' => 1581,
                                    'sire_going_runs' => 1581,
                                    'sire_going_wins' => 137,
                                    'win_percentage' => 9,
                                    'impact_value' => null,
                                )
                            ),
                            'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good_to_firm',
                                    'wins' => 138,
                                    'runs' => 1372,
                                    'sire_going_runs' => 1372,
                                    'sire_going_wins' => 138,
                                    'win_percentage' => 10,
                                    'impact_value' => null,
                                )
                            ),
                            'good_to_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good_to_soft',
                                    'wins' => 150,
                                    'runs' => 1662,
                                    'sire_going_runs' => 1662,
                                    'sire_going_wins' => 150,
                                    'win_percentage' => 9,
                                    'impact_value' => null,
                                )
                            ),
                            'soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'soft',
                                    'wins' => 211,
                                    'runs' => 2638,
                                    'sire_going_runs' => 2638,
                                    'sire_going_wins' => 211,
                                    'win_percentage' => 8,
                                    'impact_value' => null,
                                )
                            ),
                            'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'good',
                                    'wins' => 313,
                                    'runs' => 3087,
                                    'sire_going_runs' => 3087,
                                    'sire_going_wins' => 313,
                                    'win_percentage' => 10,
                                    'impact_value' => null,
                                )
                            ),
                            'firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'going_group' => 'firm',
                                    'wins' => 36,
                                    'runs' => 283,
                                    'sire_going_runs' => 283,
                                    'sire_going_wins' => 36,
                                    'win_percentage' => 13,
                                    'impact_value' => null,
                                )
                            ),
                        ),
                    )
                ),
            ),
        ];

        return isset($data[$key]) ? $data[$key] : null;
    }
}
