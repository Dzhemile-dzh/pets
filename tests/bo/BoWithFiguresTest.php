<?php

namespace Tests;

class BoWithFiguresTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param       $courseMaps
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetFiguresArray
     */
    public function testGetFiguresArray(
        array $races,
        array $seasons,
        $maxRaces,
        array $expectedResult
    ) {

        $object = new \Tests\Stubs\Bo\BoWithFigures(
            new \Api\Input\Request\Horses\RaceCards\Runners(
                [],
                ['raceId' => 646583]
            )
        );
        $reflector = new \ReflectionClass('\Tests\Stubs\Bo\BoWithFigures');
        $method = $reflector->getMethod(
            'getFiguresArray'
        );
        $method->setAccessible(true);

        $result = $method->invokeArgs(
            $object,
            [
                $races,
                $seasons,
                $maxRaces,
            ]
        );

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($result)
        );
    }

    /**
     * @return array
     */
    public function providerTestGetFiguresArray()
    {
        return [
            [
                [
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 738523,
                            'race_instance_uid' => 634591,
                            'race_datetime' => 'Oct 2 2015 4:50PM',
                            'race_type_code' => 'C',
                            'race_outcome_position' => 0,
                            'race_outcome_form_char' => 'F',
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 738523,
                            'race_instance_uid' => 632262,
                            'race_datetime' => 'Aug 22 2015 5:35PM',
                            'race_type_code' => 'C',
                            'race_outcome_position' => 7,
                            'race_outcome_form_char' => '0',
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 738523,
                            'race_instance_uid' => 629043,
                            'race_datetime' => 'Jul 2 2015 4:30PM',
                            'race_type_code' => 'C',
                            'race_outcome_position' => 4,
                            'race_outcome_form_char' => '4',
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 738523,
                            'race_instance_uid' => 624531,
                            'race_datetime' => 'May 16 2015 3:30PM',
                            'race_type_code' => 'C',
                            'race_outcome_position' => 5,
                            'race_outcome_form_char' => '5',
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 738523,
                            'race_instance_uid' => 623161,
                            'race_datetime' => 'May 2 2015 6:30PM',
                            'race_type_code' => 'C',
                            'race_outcome_position' => 1,
                            'race_outcome_form_char' => '1'
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 738523,
                            'race_instance_uid' => 621862,
                            'race_datetime' => 'Apr 13 2015 2:30PM',
                            'race_type_code' => 'C',
                            'race_outcome_position' => 6,
                            'race_outcome_form_char' => '6',
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 738523,
                            'race_instance_uid' => 618524,
                            'race_datetime' => 'Feb 28 2015 3:35PM',
                            'race_type_code' => 'C',
                            'race_outcome_position' => 8,
                            'race_outcome_form_char' => '0',
                        ]
                    )
                ],
                [
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'season_start_date' => 'Apr 26 2015 12:00AM',
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'season_start_date' => 'Apr 27 2014 12:00AM'
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'season_start_date' => 'Apr 28 2013 12:00AM',
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'season_start_date' => 'Apr 29 2012 12:00AM',
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'season_start_date' => 'Apr 24 2011 12:00AM',
                        ]
                    ),
                ],
                6,
                [
                    (Object)[
                        'form_figure' => 'F',
                        'race_type_code' => 'C'
                    ],
                    (Object)[
                        'form_figure' => '7',
                        'race_type_code' => 'C'
                    ],
                    (Object)[
                        'form_figure' => '4',
                        'race_type_code' => 'C'
                    ],
                    (Object)[
                        'form_figure' => '5',
                        'race_type_code' => 'C'
                    ],
                    (Object)[
                        'form_figure' => '1',
                        'race_type_code' => 'C'
                    ],
                    (Object)[
                        'form_figure' => '-',
                        'race_type_code' => null
                    ],
                ]
            ],
            [
                [
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 738523,
                            'race_instance_uid' => 634591,
                            'race_datetime' => 'Oct 2 2015 4:50PM',
                            'race_type_code' => 'C',
                            'race_outcome_position' => 0,
                            'race_outcome_form_char' => 'F',
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 738523,
                            'race_instance_uid' => 632262,
                            'race_datetime' => 'Aug 22 2015 5:35PM',
                            'race_type_code' => 'C',
                            'race_outcome_position' => 7,
                            'race_outcome_form_char' => '0',
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 738523,
                            'race_instance_uid' => 629043,
                            'race_datetime' => 'Jul 2 2015 4:30PM',
                            'race_type_code' => 'C',
                            'race_outcome_position' => 4,
                            'race_outcome_form_char' => '4',
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 738523,
                            'race_instance_uid' => 624531,
                            'race_datetime' => 'May 16 2015 3:30PM',
                            'race_type_code' => 'C',
                            'race_outcome_position' => 5,
                            'race_outcome_form_char' => '5',
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 738523,
                            'race_instance_uid' => 623161,
                            'race_datetime' => 'May 2 2015 6:30PM',
                            'race_type_code' => 'C',
                            'race_outcome_position' => 1,
                            'race_outcome_form_char' => '1'
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 738523,
                            'race_instance_uid' => 621862,
                            'race_datetime' => 'Apr 13 2015 2:30PM',
                            'race_type_code' => 'C',
                            'race_outcome_position' => 6,
                            'race_outcome_form_char' => '6',
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 738523,
                            'race_instance_uid' => 618524,
                            'race_datetime' => 'Feb 28 2015 3:35PM',
                            'race_type_code' => 'C',
                            'race_outcome_position' => 8,
                            'race_outcome_form_char' => '0',
                        ]
                    )
                ],
                [
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'season_start_date' => 'Apr 26 2015 12:00AM',
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'season_start_date' => 'Apr 27 2014 12:00AM'
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'season_start_date' => 'Apr 28 2013 12:00AM',
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'season_start_date' => 'Apr 29 2012 12:00AM',
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'season_start_date' => 'Apr 24 2011 12:00AM',
                        ]
                    ),
                ],
                2,
                [
                    (Object)[
                        'form_figure' => 'F',
                        'race_type_code' => 'C'
                    ],
                    (Object)[
                        'form_figure' => '7',
                        'race_type_code' => 'C'
                    ]
                ]
            ],
            [
                [
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 738523,
                            'race_instance_uid' => 634591,
                            'race_datetime' => 'Oct 2 2015 4:50PM',
                            'race_type_code' => 'C',
                            'race_outcome_position' => 0,
                            'race_outcome_form_char' => 'F',
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 738523,
                            'race_instance_uid' => 632262,
                            'race_datetime' => 'Aug 22 2015 5:35PM',
                            'race_type_code' => 'C',
                            'race_outcome_position' => 7,
                            'race_outcome_form_char' => '0',
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 738523,
                            'race_instance_uid' => 629043,
                            'race_datetime' => 'Jul 2 2015 4:30PM',
                            'race_type_code' => 'C',
                            'race_outcome_position' => 4,
                            'race_outcome_form_char' => '4',
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 738523,
                            'race_instance_uid' => 624531,
                            'race_datetime' => 'May 16 2015 3:30PM',
                            'race_type_code' => 'C',
                            'race_outcome_position' => 5,
                            'race_outcome_form_char' => '5',
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 738523,
                            'race_instance_uid' => 623161,
                            'race_datetime' => 'May 2 2015 6:30PM',
                            'race_type_code' => 'C',
                            'race_outcome_position' => 1,
                            'race_outcome_form_char' => '1'
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 738523,
                            'race_instance_uid' => 621862,
                            'race_datetime' => 'Apr 13 2015 2:30PM',
                            'race_type_code' => 'C',
                            'race_outcome_position' => 6,
                            'race_outcome_form_char' => '6',
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 738523,
                            'race_instance_uid' => 618524,
                            'race_datetime' => 'Feb 28 2015 3:35PM',
                            'race_type_code' => 'C',
                            'race_outcome_position' => 8,
                            'race_outcome_form_char' => '0',
                        ]
                    )
                ],
                [
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'season_start_date' => 'Apr 26 2015 12:00AM',
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'season_start_date' => 'Apr 27 2014 12:00AM'
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'season_start_date' => 'Apr 28 2013 12:00AM',
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'season_start_date' => 'Apr 29 2012 12:00AM',
                        ]
                    ),
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'season_start_date' => 'Apr 24 2011 12:00AM',
                        ]
                    ),
                ],
                null,
                [
                    (Object)[
                        'form_figure' => 'F',
                        'race_type_code' => 'C'
                    ],
                    (Object)[
                        'form_figure' => '7',
                        'race_type_code' => 'C'
                    ],
                    (Object)[
                        'form_figure' => '4',
                        'race_type_code' => 'C'
                    ],
                    (Object)[
                        'form_figure' => '5',
                        'race_type_code' => 'C'
                    ],
                    (Object)[
                        'form_figure' => '1',
                        'race_type_code' => 'C'
                    ],
                    (Object)[
                        'form_figure' => '-',
                        'race_type_code' => null
                    ],
                    (Object)[
                        'form_figure' => '6',
                        'race_type_code' => 'C'
                    ],
                    (Object)[
                        'form_figure' => '8',
                        'race_type_code' => 'C'
                    ],
                ]
            ],
        ];
    }
}
