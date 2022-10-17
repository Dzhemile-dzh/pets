<?php

namespace Tests\Stubs\Data\Horses\OwnerGroups\CountryList\WithOptionalParameters;

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
            'b72f3c4d9bcc87634e987b910552bc87' => [
                [
                    'country_code' => 'FR ',
                    'country_desc' => 'France',
                ],
                [
                    'country_code' => 'GB ',
                    'country_desc' => 'Great Britain',
                ],
                [
                    'country_code' => 'UAE',
                    'country_desc' => 'United Arab Emirates',
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
