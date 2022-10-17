<?php

namespace Tests;

/**
 * Class GetHorseAgeTest
 *
 * @package Tests
 */
class GetHorseAgeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Api\Row\Horse $row
     * @param array $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testGetHorseAgeRace(\Api\Row\Horse $row, $expectedResult)
    {
        $this->assertEquals($expectedResult, $row->getHorseAge(date("Y-m-d H:i:s")));
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return[
            [
                \Api\Row\Horse::createFromArray([
                    'horse_date_of_birth' => '2010-01-01',
                    'horse_date_of_death' => null,
                    'country_origin_code' => 'GB'
                ]),
                (date('Y') - 2010) . '-y-o'
            ],
            [
                \Api\Row\Horse::createFromArray([
                    'horse_date_of_birth' => '2010-01-01',
                    'horse_date_of_death' => null,
                    'country_origin_code' => 'URU'
                ]),
                (date('Y') - 2010 - (date('m') < 7 ? 1 : 0)) . '-y-o'
            ],
            [
                \Api\Row\Horse::createFromArray([
                    'horse_date_of_birth' => '2010-08-08',
                    'horse_date_of_death' => '2013-01-08',
                    'country_origin_code' => 'AUS'
                ]),
                "Died as a 2-y-o"
            ],
            [
                \Api\Row\Horse::createFromArray([
                    'horse_date_of_birth' => '2010-08-08',
                    'horse_date_of_death' => '2013-01-08',
                    'country_origin_code' => 'IRE'
                ]),
                "Died as a 3-y-o"
            ],
            [
                \Api\Row\Horse::createFromArray([
                    'horse_date_of_birth' => '1910-08-08',
                    'horse_date_of_death' => '',
                    'country_origin_code' => 'GB'
                ]),
                ''
            ],
        ];
    }
}
