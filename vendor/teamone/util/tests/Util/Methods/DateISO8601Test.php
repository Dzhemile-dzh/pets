<?php

namespace Test\Util\Math;

use RP\Util\Methods\DateISO8601;
use Test\Stubs\Methods\DateISO8601Stub;

/**
 * Class DateISO8601Test
 * @package Test\Util\Math
 */
class DateISO8601Test extends \PHPUnit\Framework\TestCase
{
    /**
     * @var $stub DateISO8601
     */
    private $stub;

    /**
     * setup
     */
    public function setUp()
    {
        $this->stub = new DateISO8601Stub();
    }

    /*
    public function testInvalidLocalDateISO8601()
    {
        $dateString         = 'last day +10h -1day';
        $hoursDifference    = '0';

        $this->assertSame(
            $dateString,
            $this->stub->localDateISO8601($dateString, $hoursDifference)
        );
    }
    */

    /**
     *
     * @dataProvider providerLocalDateISO8601
     */
    public function testLocalDateISO8601($dateRaw, $dateExpected)
    {
        $this->assertSame(
            $dateExpected,
            $this->stub->localDateISO8601($dateRaw[0], $dateRaw[1])
        );
    }

    /**
     * @return array
     */
    public function providerLocalDateISO8601()
    {
        return [
            [
                [//winter time
                    '2018-01-01',
                    '1'
                ],
                '2018-01-01T01:00:00+01:00'
            ],
            [
                [//winter time
                    '2018-01-01',
                    '0'
                ],
                '2018-01-01T00:00:00+00:00'
            ],
            [
                [//summer time
                    '2018-05-01 00:00:00',
                    '-4'
                ],
                '2018-04-30T20:00:00-03:00'
            ]
        ];
    }

    /**
     *
     * @dataProvider providerTestDateISO8601
     */
    public function testDateISO8601($dateRaw, $dateExpected)
    {
        $this->assertSame(
            $dateExpected,
            $this->stub->dateISO8601($dateRaw)
        );
    }

    /**
     * @return array
     */
    public function providerTestDateISO8601()
    {
        return [
            [
                '2014-01-01',
                '2014-01-01T00:00:00+00:00'
            ],
            [
                '2014-02-02 00:02',
                '2014-02-02T00:02:00+00:00'
            ],
            [
                '2014-02-02 00:02:02',
                '2014-02-02T00:02:02+00:00'
            ],
            [
                '2014-02-02 00:02:67',
                '2014-02-02 00:02:67'
            ],
            [
                'dddd',
                'dddd'
            ]
        ];
    }
}
