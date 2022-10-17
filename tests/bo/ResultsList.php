<?php

namespace Tests\Bo;

use Bo\Native\Results\ResultsList;

class ResultsListTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Tests grouping of similar meeting names under one (with more races or turf)
     *
     * @dataProvider provideData
     */
    public function testGroupingByMeetingName($input, $expectedOutput)
    {
        $data = $input;

        $result = ResultsList::getGroupedSimilarMeetingNames($data);

        self::assertSame(
            json_encode($expectedOutput),
            json_encode($result)
        );
    }

    public function provideData()
    {
        return [
            "Should pick both courses because of different countries" => [
                "input" => [
                    (object) [
                        "course_name" => "Ascot",
                        "course_country" => "GB",
                        "races" => [
                            (object) ["race_uid" => 4, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 5, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 6, "race_datetime" => "2018-06-18 2:40:00"]
                        ]
                    ],
                    (object) [
                        "course_name" => "Ascot (AUS)",
                        "course_country" => "AUS",
                        "races" => [
                            (object) ["race_uid" => 1, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 2, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 3, "race_datetime" => "2018-06-18 2:40:00"]
                        ]
                    ]
                ],
                "expectedOutput" => [
                    (object) [
                        "course_name" => "Ascot",
                        "course_country" => "GB",
                        "races" => [
                            (object) ["race_uid" => 4, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 5, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 6, "race_datetime" => "2018-06-18 2:40:00"]
                        ]
                    ],
                    (object) [
                        "course_name" => "Ascot (AUS)",
                        "course_country" => "AUS",
                        "races" => [
                            (object) ["race_uid" => 1, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 2, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 3, "race_datetime" => "2018-06-18 2:40:00"]
                        ]
                    ]
                ]
            ],
            "Should pick without (A.W) because of equal races count" => [
                "input" => [
                    (object) [
                        "course_name" => "Lingfield (A.W)",
                        "course_country" => "GB",
                        "races" => [
                            (object) ["race_uid" => 4, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 5, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 6, "race_datetime" => "2018-06-18 2:40:00"]
                        ]
                    ],
                    (object) [
                        "course_name" => "Lingfield",
                        "course_country" => "GB",
                        "races" => [
                            (object) ["race_uid" => 1, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 2, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 3, "race_datetime" => "2018-06-18 2:40:00"]
                        ]
                    ]
                ],
                "expectedOutput" => [
                    (object) [
                        "course_name" => "Lingfield",
                        "course_country" => "GB",
                        "races" => [
                            (object) ["race_uid" => 1, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 2, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 3, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 4, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 5, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 6, "race_datetime" => "2018-06-18 2:40:00"]
                        ]
                    ]
                ]
            ],
            "Should pick Lingfield (A.W) (GB)" => [
                "input" => [
                    (object) [
                        "course_name" => "Lingfield (A.W)",
                        "course_country" => "GB",
                        "races" => [
                            (object) ["race_uid" => 4, "race_datetime" => "2018-06-18 2:40:00"],
                        ]
                    ],
                    (object) [
                        "course_name" => "Lingfield (A.W) (GB)",
                        "course_country" => "GB",
                        "races" => [
                            (object) ["race_uid" => 1, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 2, "race_datetime" => "2018-06-18 2:40:00"]
                        ]
                    ]
                ],
                "expectedOutput" => [
                    (object) [
                        "course_name" => "Lingfield (A.W) (GB)",
                        "course_country" => "GB",
                        "races" => [
                            (object) ["race_uid" => 1, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 2, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 4, "race_datetime" => "2018-06-18 2:40:00"]
                        ]
                    ]
                ]
            ],
            "Should sort races by date" => [
                "input" => [
                    (object) [
                        "course_name" => "Lingfield (A.W)",
                        "course_country" => "GB",
                        "races" => [
                            (object) ["race_uid" => 4, "race_datetime" => "2018-06-18 2:42:00"],
                        ]
                    ],
                    (object) [
                        "course_name" => "Lingfield (A.W) (GB)",
                        "course_country" => "GB",
                        "races" => [
                            (object) ["race_uid" => 1, "race_datetime" => "2018-06-18 2:41:00"],
                            (object) ["race_uid" => 2, "race_datetime" => "2018-06-18 2:43:00"]
                        ]
                    ]
                ],
                "expectedOutput" => [
                    (object) [
                        "course_name" => "Lingfield (A.W) (GB)",
                        "course_country" => "GB",
                        "races" => [
                            (object) ["race_uid" => 1, "race_datetime" => "2018-06-18 2:41:00"],
                            (object) ["race_uid" => 4, "race_datetime" => "2018-06-18 2:42:00"],
                            (object) ["race_uid" => 2, "race_datetime" => "2018-06-18 2:43:00"]
                        ]
                    ]
                ]
            ],
            "Should pick Lingfield (A.W) (GB) because of most races" => [
                "input" => [
                    (object) [
                        "course_name" => "Lingfield (A.W)",
                        "course_country" => "GB",
                        "races" => [
                            (object) ["race_uid" => 1, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 2, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 3, "race_datetime" => "2018-06-18 2:40:00"],
                        ]
                    ],
                    (object) [
                        "course_name" => "Lingfield (A.W) (GB)",
                        "course_country" => "GB",
                        "races" => [
                            (object) ["race_uid" => 1, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 2, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 3, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 4, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 5, "race_datetime" => "2018-06-18 2:40:00"]
                        ]
                    ],
                    (object) [
                        "course_name" => "Lingfield (GB)",
                        "course_country" => "GB",
                        "races" => [
                            (object) ["race_uid" => 1, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 2, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 3, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 4, "race_datetime" => "2018-06-18 2:40:00"]
                        ]
                    ]
                ],
                "expectedOutput" => [
                    (object) [
                        "course_name" => "Lingfield (A.W) (GB)",
                        "course_country" => "GB",
                        "races" => [
                            (object) ["race_uid" => 1, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 2, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 3, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 4, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 5, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 1, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 2, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 3, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 1, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 2, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 3, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 4, "race_datetime" => "2018-06-18 2:40:00"]
                        ]
                    ]
                ]
            ],
            "Should pick anyname (A.W) (GB) with any name, messed positions, more other items" => [
                "input" => [
                    (object) [
                        "course_name" => "anyname (A.W)",
                        "course_country" => "GB",
                        "races" => [
                            (object) ["race_uid" => 1, "race_datetime" => "2018-06-18 2:40:00"]
                        ]
                    ],
                    (object) [
                        "course_name" => "another item 1",
                        "course_country" => "GB",
                        "races" => [
                            (object) ["race_uid" => 1, "race_datetime" => "2018-06-18 2:40:00"]
                        ]
                    ],
                    (object) [
                        "course_name" => "anyname (A.W) (GB)",
                        "course_country" => "GB",
                        "races" => [
                            (object) ["race_uid" => 1, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 2, "race_datetime" => "2018-06-18 2:40:00"]
                        ]
                    ],
                    (object) [
                        "course_name" => "another item 2",
                        "course_country" => "GB",
                        "races" => [
                            (object) ["race_uid" => 1, "race_datetime" => "2018-06-18 2:40:00"]
                        ]
                    ],
                    (object) [
                        "course_name" => "anyname (GB)",
                        "course_country" => "GB",
                        "races" => [
                            (object) ["race_uid" => 1, "race_datetime" => "2018-06-18 2:40:00"]
                        ]
                    ]
                ],
                "expectedOutput" => [
                    (object) [
                        "course_name" => "another item 1",
                        "course_country" => "GB",
                        "races" => [
                            (object) ["race_uid" => 1, "race_datetime" => "2018-06-18 2:40:00"]
                        ]
                    ],
                    (object) [
                        "course_name" => "anyname (A.W) (GB)",
                        "course_country" => "GB",
                        "races" => [
                            (object) ["race_uid" => 1, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 2, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 1, "race_datetime" => "2018-06-18 2:40:00"],
                            (object) ["race_uid" => 1, "race_datetime" => "2018-06-18 2:40:00"]
                        ]
                    ],
                    (object) [
                        "course_name" => "another item 2",
                        "course_country" => "GB",
                        "races" => [
                            (object) ["race_uid" => 1, "race_datetime" => "2018-06-18 2:40:00"]
                        ]
                    ]
                ]
            ]
        ];
    }
}
