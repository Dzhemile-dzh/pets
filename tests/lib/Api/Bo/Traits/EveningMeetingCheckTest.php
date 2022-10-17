<?php

namespace Tests\Lib\Bo\Traits;

use Api\Bo\Traits\EveningMeetingCheck;

class EveningMeetingCheckTest extends \PHPUnit\Framework\TestCase
{
    use EveningMeetingCheck;

    /**
     * @param $raceDatetime
     * @param $expectedResult
     *
     * @dataProvider dataProviderIsEveningMeeting
     * @throws \Exception
     */
    public function testIsEveningMeeting($raceDatetime, $expectedResult)
    {
        $eveningMeeting = $this->isEveningMeeting($raceDatetime);
        $this->assertEquals($expectedResult, $eveningMeeting);
    }

    public function dataProviderIsEveningMeeting()
    {
        return [
            [
                '2021-03-01 14:10:00',
                false,
            ],
            [
                '2021-03-01 15:10:00',
                true,
            ],
            [
                '2021-03-01 16:10:00',
                true,
            ],
        ];
    }

    /**
     * @param $raceDatetime
     * @param $expectedResult
     *
     * @dataProvider dataProviderGetEveningMeetingFlag
     * @throws \Exception
     */
    public function testGetEveningMeetingFlag($raceDatetime, $expectedResult)
    {
        $eveningMeeting = $this->getEveningMeetingFlag($raceDatetime);
        $this->assertEquals($expectedResult, $eveningMeeting);
    }

    public function dataProviderGetEveningMeetingFlag()
    {
        return [
            [
                '2021-03-01 14:10:00',
                -1,
            ],
            [
                '2021-03-01 15:10:00',
                1,
            ],
            [
                '2021-03-01 16:10:00',
                1,
            ],
        ];
    }
}
