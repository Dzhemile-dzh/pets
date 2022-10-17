<?php
namespace Tests;

use Phalcon\Exception;
use Api\Row\Horse;
use Api\Row\RaceMeetings\SilksGen;
use Phalcon\Mvc\Model\Row\General;

class GetSilkImagePathTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param General $row
     * @param array   $expectedResult
     * @param string  $fileType
     *
     * @dataProvider dataProvider
     */
    public function testGetSilkImagePath(General $row, $expectedResult, $fileType = '')
    {
        $this->assertEquals($expectedResult, $row->getSilkImagePath($fileType));
    }

    /**
     * @return array
     */
    public function dataProvider()
    {

        return [
            [
                Horse::createFromArray(
                    [
                        'owner_uid' => 123456
                    ]
                ),
                '6/5/4/123456'
            ],
            [
                Horse::createFromArray(
                    [
                        'owner_uid' => null
                    ]
                ),
                null
            ],
            [
                Horse::createFromArray(
                    [
                        'rp_owner_choice' => 'a',
                        'owner_uid' => 123456,
                    ]
                ),
                '6/5/4/123456'
            ],
            [
                Horse::createFromArray(
                    [
                        'rp_owner_choice' => 'b',
                        'owner_uid' => 123456,
                    ]
                ),
                'b/6/5/123456b'
            ],
            [
                SilksGen::createFromArray(
                    [
                        'owner_uid' => 123456
                    ]
                ),
                '6/5/4/123456.png',
                'png',
            ],
            [
                Horse::createFromArray(
                    [
                        'rp_owner_choice' => 'b',
                        'owner_uid' => 123456,
                    ]
                ),
                'b/6/5/123456b.gif',
                'gif',
            ],
        ];
    }
}
