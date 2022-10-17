<?php

namespace Tests;

use Phalcon\Exception;

class GetTimeBeforeUpdateTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Closure $row
     * @param int $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testGetTimeBeforeUpdate(\Closure $getRaceDatetimeFunction, $expectedResult)
    {

        $row = \Api\Row\RaceInstance::createFromArray(['race_datetime' => $getRaceDatetimeFunction()]);

        $this->assertEquals($expectedResult, $row->getTimeBeforeUpdate());
    }

    /**
     * @return array
     */
    public function dataProvider()
    {

        $expectedResultForPlus2Days = 2*24*60*60 - 600;

        //handle winter and summer time jumps
        if (date('I') > date('I', strtotime('+2 days'))) {
            $expectedResultForPlus2Days += 3600;
        } if (date('I') < date('I', strtotime('+2 days'))) {
            $expectedResultForPlus2Days -= 3600;
        }

        return [
            [
                function () {
                    return date('Y-m-d H:i:s', strtotime('+20 minutes'));
                } ,
                600
            ],
            [
                function () {
                    return date('Y-m-d H:i:s', strtotime('+2 days'));
                },
                $expectedResultForPlus2Days
            ],
            [
                function () {
                    return date('Y-m-d H:i:s', strtotime('+5 minutes'));
                },
                0
            ],
            [
                function () {
                    return date('Y-m-d H:i:s', strtotime('-5 minutes'));
                },
                0
            ],
        ];
    }
}
