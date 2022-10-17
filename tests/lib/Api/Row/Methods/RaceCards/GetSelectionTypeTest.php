<?php

namespace Tests;

use Phalcon\Exception;

class GetSelectionTypeTest extends \PHPUnit\Framework\TestCase
{
    /**
     *
     *
     */
    /**
     * @param \Api\Row\RaceCards\Selections $row
     * @param array                                       $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testGetSelectionType(
        \Api\Row\RaceCards\Selections $row,
        $expectedResult
    ) {

        $this->assertEquals($expectedResult, $row->getSelectionType());
    }

    /**
     * @return array
     */
    public function dataProvider()
    {

        return [
            [
                \Api\Row\RaceCards\Selections::createFromArray(
                    [
                        'selection_type' => '',
                        'newspaper_uid' => 2
                    ]
                ),
                null
            ],
            [
                \Api\Row\RaceCards\Selections::createFromArray(
                    [
                        'selection_type' => 'NB',
                        'newspaper_uid' => 2
                    ]
                ),
                '(nb)'
            ],
            [
                \Api\Row\RaceCards\Selections::createFromArray(
                    [
                        'selection_type' => 'NB',
                        'newspaper_uid' => 1
                    ]
                ),
                '*'
            ],
            [
                \Api\Row\RaceCards\Selections::createFromArray(
                    [
                        'selection_type' => 'NAP',
                        'newspaper_uid' => 2
                    ]
                ),
                '*'
            ],
            [
                \Api\Row\RaceCards\Selections::createFromArray(
                    [
                        'selection_type' => 'TIP',
                        'newspaper_uid' => 2
                    ]
                ),
                ''
            ],
        ];
    }
}
