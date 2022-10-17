<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 4:23 PM
 */

namespace Tests\Mvc\Model\Resultset\Utility;

use Phalcon\Mvc\Model\Resultset\Utility\GroupResult;
use Phalcon\Mvc\Model\Row\General;

/**
 * @package Tests\Mvc\Model\Resultset\Utility
 */
class GroupResultTest extends \Tests\CommonTestCase
{
    /**
     *
     * @dataProvider providerTestGroupedResult
     */
    public function testGetGroupedResult(array $plain, array $structure, array $expectedResult)
    {
        $groupResult = new GroupResult();
        $this->assertEquals($expectedResult, $groupResult->getGroupedResult($plain, $structure));
    }

    /**
     * @return array
     */
    public function providerTestGroupedResult()
    {
        $res = [];
        for ($i = 0; $i < 10; $i++) {
            $input = $this->getInputForTestGroupedResult();
            foreach ($input[0] as &$row) {
                $this->shuffleAssoc($row);
            }
            unset($row);
            $res[] = $input;
        }
        return $res;
    }

    /**
     * @param array $array
     * @return bool
     */
    private function shuffleAssoc(array &$array)
    {
        $keys = array_keys($array);
        $new = [];

        shuffle($keys);

        foreach ($keys as $key) {
            $new[$key] = $array[$key];
        }

        $array = $new;

        return true;
    }

    /**
     * @return array
     */
    private function getInputForTestGroupedResult()
    {
        return [
            [
                [
                    'gr1_key1' => 'gr1_key1_val01',
                    'gr1_key2' => 'gr1_key2_val02',
                    'gr1_key3' => 'gr1_key3_val03',
                    'gr1_subgr1_key1' => 'gr1_subgr1_key1_val04',
                    'gr1_subgr1_key2' => 'gr1_subgr1_key2_val05',
                    'gr1_subgr1_key3' => 'gr1_subgr1_key3_val06',
                    'gr1_subgr1_subgr1_key1' => 'gr1_subgr1_subgr1_key1_val07',
                    'gr1_subgr1_subgr1_key2' => 'gr1_subgr1_subgr1_key2_val08',
                    'gr1_subgr1_subgr1_key3' => 'gr1_subgr1_subgr1_key3_val09',
                    'gr1_subgr2_key1' => 'gr1_subgr2_key1_val010',
                    'gr1_subgr2_key2' => 'gr1_subgr2_key2_val011',
                    'gr1_subgr2_key3' => 'gr1_subgr2_key3_val012',
                ],
                [
                    'gr1_key1' => 'gr1_key1_val01',
                    'gr1_key2' => 'gr1_key2_val02',
                    'gr1_key3' => 'gr1_key3_val03',
                    'gr1_subgr1_key1' => 'gr1_subgr1_key1_val04',
                    'gr1_subgr1_key2' => 'gr1_subgr1_key2_val05',
                    'gr1_subgr1_key3' => 'gr1_subgr1_key3_val06',
                    'gr1_subgr1_subgr1_key1' => 'gr1_subgr1_subgr1_key1_val17',
                    'gr1_subgr1_subgr1_key2' => 'gr1_subgr1_subgr1_key2_val18',
                    'gr1_subgr1_subgr1_key3' => 'gr1_subgr1_subgr1_key3_val19',
                    'gr1_subgr2_key1' => 'gr1_subgr2_key1_val010',
                    'gr1_subgr2_key2' => 'gr1_subgr2_key2_val011',
                    'gr1_subgr2_key3' => 'gr1_subgr2_key3_val012',
                ],
                [
                    'gr1_key1' => 'gr1_key1_val01',
                    'gr1_key2' => 'gr1_key2_val02',
                    'gr1_key3' => 'gr1_key3_val03',
                    'gr1_subgr1_key1' => 'gr1_subgr1_key1_val24',
                    'gr1_subgr1_key2' => 'gr1_subgr1_key2_val25',
                    'gr1_subgr1_key3' => 'gr1_subgr1_key3_val26',
                    'gr1_subgr1_subgr1_key1' => 'gr1_subgr1_subgr1_key1_val27',
                    'gr1_subgr1_subgr1_key2' => 'gr1_subgr1_subgr1_key2_val28',
                    'gr1_subgr1_subgr1_key3' => 'gr1_subgr1_subgr1_key3_val29',
                    'gr1_subgr2_key1' => 'gr1_subgr2_key1_val210',
                    'gr1_subgr2_key2' => 'gr1_subgr2_key2_val211',
                    'gr1_subgr2_key3' => 'gr1_subgr2_key3_val212',
                ],
                [
                    'gr1_key1' => 'gr1_key1_val11',
                    'gr1_key2' => 'gr1_key2_val12',
                    'gr1_key3' => 'gr1_key3_val13',
                    'gr1_subgr1_key1' => 'gr1_subgr1_key1_val34',
                    'gr1_subgr1_key2' => 'gr1_subgr1_key2_val35',
                    'gr1_subgr1_key3' => 'gr1_subgr1_key3_val36',
                    'gr1_subgr1_subgr1_key1' => 'gr1_subgr1_subgr1_key1_val37',
                    'gr1_subgr1_subgr1_key2' => 'gr1_subgr1_subgr1_key2_val38',
                    'gr1_subgr1_subgr1_key3' => 'gr1_subgr1_subgr1_key3_val39',
                    'gr1_subgr2_key1' => 'gr1_subgr2_key1_val310',
                    'gr1_subgr2_key2' => 'gr1_subgr2_key2_val311',
                    'gr1_subgr2_key3' => 'gr1_subgr2_key3_val312',
                ],
                [
                    'gr1_key1' => 'gr1_key1_val11',
                    'gr1_key2' => 'gr1_key2_val12',
                    'gr1_key3' => 'gr1_key3_val13',
                    'gr1_subgr1_key1' => 'gr1_subgr1_key1_val34',
                    'gr1_subgr1_key2' => 'gr1_subgr1_key2_val35',
                    'gr1_subgr1_key3' => 'gr1_subgr1_key3_val36',
                    'gr1_subgr1_subgr1_key1' => 'gr1_subgr1_subgr1_key1_val47',
                    'gr1_subgr1_subgr1_key2' => 'gr1_subgr1_subgr1_key2_val48',
                    'gr1_subgr1_subgr1_key3' => 'gr1_subgr1_subgr1_key3_val49',
                    'gr1_subgr2_key1' => 'gr1_subgr2_key1_val310',
                    'gr1_subgr2_key2' => 'gr1_subgr2_key2_val311',
                    'gr1_subgr2_key3' => 'gr1_subgr2_key3_val312',
                ],
                [
                    'gr1_key1' => 'gr1_key1_val11',
                    'gr1_key2' => 'gr1_key2_val12',
                    'gr1_key3' => 'gr1_key3_val13',
                    'gr1_subgr1_key1' => 'gr1_subgr1_key1_val54',
                    'gr1_subgr1_key2' => 'gr1_subgr1_key2_val55',
                    'gr1_subgr1_key3' => 'gr1_subgr1_key3_val56',
                    'gr1_subgr1_subgr1_key1' => 'gr1_subgr1_subgr1_key1_val57',
                    'gr1_subgr1_subgr1_key2' => 'gr1_subgr1_subgr1_key2_val58',
                    'gr1_subgr1_subgr1_key3' => 'gr1_subgr1_subgr1_key3_val59',
                    'gr1_subgr2_key1' => 'gr1_subgr2_key1_val510',
                    'gr1_subgr2_key2' => 'gr1_subgr2_key2_val511',
                    'gr1_subgr2_key3' => 'gr1_subgr2_key3_val512',
                ],
            ],
            [
                'gr1_key1',
                'gr1_key2' => 'renamed_gr1_key2',
                'gr1_key3',
                'subgroup1' => [
                    'gr1_subgr1_key1' => 'renamed2_gr1_subgr1_key1',
                    'gr1_subgr1_key2',
                    'gr1_subgr1_key3',
                    'subgroup1' => [
                        'gr1_subgr1_subgr1_key1',
                        'gr1_subgr1_subgr1_key2' => 'renamed3_gr1_subgr1_subgr1_key2',
                        'gr1_subgr1_subgr1_key3'
                    ]
                ],
                'subgroup2' => [
                    'gr1_subgr2_key1',
                    'gr1_subgr2_key2',
                    'gr1_subgr2_key3'
                ]
            ],
            [
                General::createFromArray(
                    [
                        'gr1_key1' => 'gr1_key1_val01',
                        'renamed_gr1_key2' => 'gr1_key2_val02',
                        'gr1_key3' => 'gr1_key3_val03',
                        'subgroup1' => [
                            General::createFromArray(
                                [
                                    'renamed2_gr1_subgr1_key1' => 'gr1_subgr1_key1_val04',
                                    'gr1_subgr1_key2' => 'gr1_subgr1_key2_val05',
                                    'gr1_subgr1_key3' => 'gr1_subgr1_key3_val06',
                                    'subgroup1' => [
                                        General::createFromArray(
                                            [
                                                'gr1_subgr1_subgr1_key1' => 'gr1_subgr1_subgr1_key1_val07',
                                                'renamed3_gr1_subgr1_subgr1_key2' => 'gr1_subgr1_subgr1_key2_val08',
                                                'gr1_subgr1_subgr1_key3' => 'gr1_subgr1_subgr1_key3_val09'
                                            ]
                                        ),
                                        General::createFromArray(
                                            [
                                                'gr1_subgr1_subgr1_key1' => 'gr1_subgr1_subgr1_key1_val17',
                                                'renamed3_gr1_subgr1_subgr1_key2' => 'gr1_subgr1_subgr1_key2_val18',
                                                'gr1_subgr1_subgr1_key3' => 'gr1_subgr1_subgr1_key3_val19'
                                            ]
                                        )
                                    ]
                                ]
                            ),
                            General::createFromArray(
                                [
                                    'renamed2_gr1_subgr1_key1' => 'gr1_subgr1_key1_val24',
                                    'gr1_subgr1_key2' => 'gr1_subgr1_key2_val25',
                                    'gr1_subgr1_key3' => 'gr1_subgr1_key3_val26',
                                    'subgroup1' => [
                                        General::createFromArray(
                                            [
                                                'gr1_subgr1_subgr1_key1' => 'gr1_subgr1_subgr1_key1_val27',
                                                'renamed3_gr1_subgr1_subgr1_key2' => 'gr1_subgr1_subgr1_key2_val28',
                                                'gr1_subgr1_subgr1_key3' => 'gr1_subgr1_subgr1_key3_val29'
                                            ]
                                        ),
                                    ]
                                ]
                            ),
                        ],
                        'subgroup2' => [
                            General::createFromArray(
                                [
                                    'gr1_subgr2_key1' => 'gr1_subgr2_key1_val010',
                                    'gr1_subgr2_key2' => 'gr1_subgr2_key2_val011',
                                    'gr1_subgr2_key3' => 'gr1_subgr2_key3_val012'
                                ]
                            ),
                            General::createFromArray(
                                [
                                    'gr1_subgr2_key1' => 'gr1_subgr2_key1_val210',
                                    'gr1_subgr2_key2' => 'gr1_subgr2_key2_val211',
                                    'gr1_subgr2_key3' => 'gr1_subgr2_key3_val212'
                                ]
                            )
                        ]
                    ]
                ),
                General::createFromArray(
                    [
                        'gr1_key1' => 'gr1_key1_val11',
                        'renamed_gr1_key2' => 'gr1_key2_val12',
                        'gr1_key3' => 'gr1_key3_val13',
                        'subgroup1' => [
                            General::createFromArray(
                                [
                                    'renamed2_gr1_subgr1_key1' => 'gr1_subgr1_key1_val34',
                                    'gr1_subgr1_key2' => 'gr1_subgr1_key2_val35',
                                    'gr1_subgr1_key3' => 'gr1_subgr1_key3_val36',
                                    'subgroup1' => [
                                        General::createFromArray(
                                            [
                                                'gr1_subgr1_subgr1_key1' => 'gr1_subgr1_subgr1_key1_val37',
                                                'renamed3_gr1_subgr1_subgr1_key2' => 'gr1_subgr1_subgr1_key2_val38',
                                                'gr1_subgr1_subgr1_key3' => 'gr1_subgr1_subgr1_key3_val39'
                                            ]
                                        ),
                                        General::createFromArray(
                                            [
                                                'gr1_subgr1_subgr1_key1' => 'gr1_subgr1_subgr1_key1_val47',
                                                'renamed3_gr1_subgr1_subgr1_key2' => 'gr1_subgr1_subgr1_key2_val48',
                                                'gr1_subgr1_subgr1_key3' => 'gr1_subgr1_subgr1_key3_val49'
                                            ]
                                        )
                                    ]
                                ]
                            ),
                            General::createFromArray(
                                [
                                    'renamed2_gr1_subgr1_key1' => 'gr1_subgr1_key1_val54',
                                    'gr1_subgr1_key2' => 'gr1_subgr1_key2_val55',
                                    'gr1_subgr1_key3' => 'gr1_subgr1_key3_val56',
                                    'subgroup1' => [
                                        General::createFromArray(
                                            [
                                                'gr1_subgr1_subgr1_key1' => 'gr1_subgr1_subgr1_key1_val57',
                                                'renamed3_gr1_subgr1_subgr1_key2' => 'gr1_subgr1_subgr1_key2_val58',
                                                'gr1_subgr1_subgr1_key3' => 'gr1_subgr1_subgr1_key3_val59'
                                            ]
                                        ),
                                    ]
                                ]
                            ),
                        ],
                        'subgroup2' => [
                            General::createFromArray(
                                [
                                    'gr1_subgr2_key1' => 'gr1_subgr2_key1_val310',
                                    'gr1_subgr2_key2' => 'gr1_subgr2_key2_val311',
                                    'gr1_subgr2_key3' => 'gr1_subgr2_key3_val312'
                                ]
                            ),
                            General::createFromArray(
                                [
                                    'gr1_subgr2_key1' => 'gr1_subgr2_key1_val510',
                                    'gr1_subgr2_key2' => 'gr1_subgr2_key2_val511',
                                    'gr1_subgr2_key3' => 'gr1_subgr2_key3_val512'
                                ]
                            )
                        ]
                    ]
                ),
            ]
        ];
    }
}
