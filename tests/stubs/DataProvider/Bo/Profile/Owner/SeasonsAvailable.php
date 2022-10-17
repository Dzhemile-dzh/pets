<?php

namespace Tests\Stubs\DataProvider\Bo\Profile\Owner;

use Api\Input\Request\Horses\Profile\Owner\SeasonsAvailable as Request;

/**
 * Class SeasonsAvailable
 * @package Tests\Stubs\DataProvider\Bo\Profile\Owner
 */
class SeasonsAvailable extends \Api\DataProvider\Bo\Profile\Owner\SeasonsAvailable
{
    /**
     * @param $request
     *
     * @return array
     */
    public function getSeasonsAvailableData(Request $request)
    {
        return [
            'FLAT' => [
                0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'season_type' => 'FLAT',
                        'season_start_date' => 'Jan  1 2017 12:00AM',
                        'season_end_date' => 'Dec 31 2017 11:59PM',
                        'season_desc' => 'Flat 2017',
                        'country_code' => 'GB ',
                    ]
                )
            ],
            'JUMPS' => [
                0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'season_type' => 'JUMPS',
                        'season_start_date' => 'Apr 26 2015 12:00AM',
                        'season_end_date' => 'Apr 23 2016 11:59PM',
                        'season_desc' => 'NH 2015-2016',
                        'country_code' => 'GB ',
                    ]
                )
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function __destruct()
    {
        return;
    }
}
