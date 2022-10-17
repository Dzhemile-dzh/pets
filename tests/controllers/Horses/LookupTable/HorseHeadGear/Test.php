<?php

namespace Tests\Controllers\Horses\LookupTable\HorseHeadGear;

use UnitTestsComponents\ApiRouteTest\Json;

/**
 * Class Test
 */
class Test extends Json
{

    public function getRoute(): string
    {
        return '/horses/lookup-table/horse-head-gear';
    }

    /**
     * Mocked data
     * Format:
     * 'some_MD5_hash' => [
     *      [row...]
     * ]
     *
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\LookupTable\HorseHeadGear ->getData()
            'b22928c0ec982a3e26e72619357f278a' => [
                [
                    'horse_head_gear_uid' => 1,
                    'horse_head_gear_code' => 'bt',
                    'horse_head_gear_desc' => 'blinkers, tongue strap',
                    'blinkers_yn' => 'Y',
                    'visors_yn' => 'N',
                    'first_time_yn' => 'N',
                    'weatherbys_code' => null,
                    'rp_horse_head_gear_code' => 'bt',
                ],
                [
                    'horse_head_gear_uid' => 2,
                    'horse_head_gear_code' => 'vt',
                    'horse_head_gear_desc' => 'tongue strap, visor',
                    'blinkers_yn' => 'N',
                    'visors_yn' => 'Y',
                    'first_time_yn' => 'N',
                    'weatherbys_code' => null,
                    'rp_horse_head_gear_code' => 'vt',
                ],
                [
                    'horse_head_gear_uid' => 3,
                    'horse_head_gear_code' => 'b',
                    'horse_head_gear_desc' => 'blinkers',
                    'blinkers_yn' => 'Y',
                    'visors_yn' => 'N',
                    'first_time_yn' => 'N',
                    'weatherbys_code' => 'B',
                    'rp_horse_head_gear_code' => 'b',
                ],
                [
                    'horse_head_gear_uid' => 5,
                    'horse_head_gear_code' => 'e/s',
                    'horse_head_gear_desc' => 'eye-shields',
                    'blinkers_yn' => 'N',
                    'visors_yn' => 'N',
                    'first_time_yn' => 'N',
                    'weatherbys_code' => null,
                    'rp_horse_head_gear_code' => 'e/s',
                ],
                [
                    'horse_head_gear_uid' => 16,
                    'horse_head_gear_code' => 'h',
                    'horse_head_gear_desc' => 'hood',
                    'blinkers_yn' => 'N',
                    'visors_yn' => 'N',
                    'first_time_yn' => 'Y',
                    'weatherbys_code' => 'H',
                    'rp_horse_head_gear_code' => 'h',
                ],
                [
                    'horse_head_gear_uid' => 19,
                    'horse_head_gear_code' => 'e/c',
                    'horse_head_gear_desc' => 'eye-covers',
                    'blinkers_yn' => 'N',
                    'visors_yn' => 'N',
                    'first_time_yn' => 'N',
                    'weatherbys_code' => 'J',
                    'rp_horse_head_gear_code' => 'e',
                ]
            ],
        ];
    }
}
