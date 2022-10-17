<?php

namespace Tests;

use Phalcon\Exception;

class GetPngSilkImageTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Phalcon\Mvc\Model\Row\General $row
     * @param array                          $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testGetPngSilkImage(
        \Phalcon\Mvc\Model\Row\General $row,
        $expectedResult
    ) {

        $this->assertEquals($expectedResult, $row->GetPngSilkImage());
    }

    /**
     * @return array
     */
    public function dataProvider()
    {

        return [
            [
                \Api\Row\Results\Horse::createFromArray(
                    [
                        'owner_uid' => 123456,
                        'rp_owner_choice' => 'a'
                    ]
                ),
                '6/5/4/123456.png'
            ],
            [
                \Api\Row\Results\Horse::createFromArray(
                    [
                        'owner_uid' => null,
                        'rp_owner_choice' => 'a'
                    ]
                ),
                null
            ],
            [
                \Api\Row\Results\Horse::createFromArray(
                    [
                        'owner_uid' => 123456,
                        'rp_owner_choice' => 'b'
                    ]
                ),
                'b/6/5/123456b.png'
            ],
            [
                \Api\Row\Results\Horse::createFromArray(
                    [
                        'owner_uid' => 123,
                        'rp_owner_choice' => ''
                    ]
                ),
                '3/2/1/123.png'
            ],
            [
                \Api\Row\Results\Horse::createFromArray(
                    [
                        'owner_uid' => 7,
                        'rp_owner_choice' => ''
                    ]
                ),
                '7/7.png'
            ],
        ];
    }
}
