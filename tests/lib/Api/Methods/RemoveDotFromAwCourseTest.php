<?php

namespace Tests;

use Phalcon\Exception;

class RemoveDotFromAwCourseTest extends \PHPUnit\Framework\TestCase
{
    use \Api\Methods\RemoveDotFromAwCourse;

    /**
     * @param $value
     * @param $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testRemoveDotFromAwCourse($value, $expectedResult)
    {
        $this->assertEquals($expectedResult, $this->removeDotFromAwCourse($value));
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [
                'Lingfield (a.w)',
                'Lingfield (AW)'
            ],
            [
                'Lingfield ( a.W )',
                'Lingfield (AW)'
            ],
            [
                'Lingfield (A.W)',
                'Lingfield (AW)'
            ],
            [
                'Southwell (A.W)',
                'Southwell (AW)'
            ],
            [
                'Lingfield',
                'Lingfield'
            ],
            [
                null,
                null
            ],
        ];
    }
}
