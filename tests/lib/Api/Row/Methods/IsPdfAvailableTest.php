<?php
namespace Tests;

use Api\Row\Course;

class IsPdfAvailableTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param Course $row
     * @param bool   $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testIsPdfAvailable(Course $row, $expectedResult)
    {
        $this->assertEquals($expectedResult, $row->isPdfAvailable());
    }

    /**
     * @return array
     */
    public function dataProvider()
    {

        return [
            [
                Course::createFromArray(
                    [
                        'country_code' => 'IRE'
                    ]
                ),
                true
            ],
            [
                Course::createFromArray(
                    [
                        'country_code' => 'GB'
                    ]
                ),
                true
            ],
            [
                Course::createFromArray(
                    [
                        'country_code' => 'UAE'
                    ]
                ),
                true
            ],
            [
                Course::createFromArray(
                    [
                        'country_code' => ''
                    ]
                ),
                false
            ],
            [
                Course::createFromArray(
                    [
                        'country_code' => null
                    ]
                ),
                false
            ],
        ];
    }
}
