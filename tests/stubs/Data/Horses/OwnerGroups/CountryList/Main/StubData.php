<?php

namespace Tests\Stubs\Data\Horses\OwnerGroups\CountryList\Main;

use UnitTestsComponents\Stubs\StubDataInterface;

/**
 * Class StubData
 *
 * @package Tests\Stubs\Data\Horses\OwnerGroups\HorseList
 */
class StubData implements StubDataInterface
{
    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\OwnerGroups\CountryList:78 ->getData()
            'ccf363d360688463cf723453bbb9e5c8' => [
                [
                    'country_code' => 'ARO',
                    'country_desc' => 'Arabia',
                ],
                [
                    'country_code' => 'AUS',
                    'country_desc' => 'Australia',
                ],
                [
                    'country_code' => 'CAN',
                    'country_desc' => 'Canada',
                ],
                [
                    'country_code' => 'FR ',
                    'country_desc' => 'France',
                ],
                [
                    'country_code' => 'GB ',
                    'country_desc' => 'Great Britain',
                ],
                [
                    'country_code' => 'GER',
                    'country_desc' => 'Germany',
                ],
                [
                    'country_code' => 'HK ',
                    'country_desc' => 'Hong Kong',
                ],
                [
                    'country_code' => 'IRE',
                    'country_desc' => 'Ireland',
                ],
                [
                    'country_code' => 'ITY',
                    'country_desc' => 'Italy',
                ],
                [
                    'country_code' => 'SAF',
                    'country_desc' => 'South Africa',
                ],
                [
                    'country_code' => 'SWI',
                    'country_desc' => 'Switzerland',
                ],
                [
                    'country_code' => 'TUR',
                    'country_desc' => 'Turkey',
                ],
                [
                    'country_code' => 'UAE',
                    'country_desc' => 'United Arab Emirates',
                ],
                [
                    'country_code' => 'USA',
                    'country_desc' => 'U.S.A',
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function getExpected(): string
    {
        return file_get_contents(dirname(__FILE__) . '/expected.json');
    }

    /**
     * @return array
     */
    public function getReplacement(): array
    {
        return [];
    }
}
