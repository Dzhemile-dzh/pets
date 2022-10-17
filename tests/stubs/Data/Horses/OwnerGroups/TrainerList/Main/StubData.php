<?php

namespace Tests\Stubs\Data\Horses\OwnerGroups\TrainerList\Main;

use UnitTestsComponents\Stubs\StubDataInterface;

/**
 * Class StubData
 *
 * @package Tests\Stubs\Data\Horses\OwnerGroups\TrainerList\Main
 */
class StubData implements StubDataInterface
{
    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\OwnerGroups\TrainerList:66 ->getData()
            'f1e78360e84f1053eecc9a286aea9f9b' => [
                [
                    'trainer_uid' => 1093,
                    'trainer_name' => 'A Fabre',
                    'trainer_country_code' => 'FR',
                    'trainer_country_desc' => 'France',
                    'owner_group_uid' => 5,
                    'owner_uid' => 7,
                    'owner_name' => 'Sheikh Juma Dalmook Al Maktoum',
                ],
                [
                    'trainer_uid' => 1093,
                    'trainer_name' => 'A Fabre',
                    'trainer_country_code' => 'FR',
                    'trainer_country_desc' => 'France',
                    'owner_group_uid' => 5,
                    'owner_uid' => 12,
                    'owner_name' => 'Sheikh Juma Dalmook Al Maktoum',
                ],
                [
                    'trainer_uid' => 14643,
                    'trainer_name' => 'A R Al Rayhi',
                    'trainer_country_code' => 'UAE',
                    'trainer_country_desc' => 'United Arab Emirates',
                    'owner_group_uid' => 100,
                    'owner_uid' => 7,
                    'owner_name' => 'Sheikh Juma Dalmook Al Maktoum',
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
