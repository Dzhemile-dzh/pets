<?php

namespace Tests\Stubs\Data\Horses\OwnerGroups\TrainerList\WithParam;

use UnitTestsComponents\Stubs\StubDataInterface;

/**
 * Class StubData
 *
 * @package Tests\Stubs\Data\Horses\OwnerGroups\TrainerList\WithOptionalParameters
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
            'bf52dd5b5742cb13176e801ade2620b7' => [
                [
                    'trainer_uid' => 25628,
                    'trainer_name' => 'Charles Hills',
                    'trainer_country_code' => 'GB',
                    'trainer_country_desc' => 'Great Britain',
                    'owner_group_uid' => 5,
                    'owner_uid' => 7,
                    'owner_name' => 'Sheikh Juma Dalmook Al Maktoum',
                ],
                [
                    'trainer_uid' => 25628,
                    'trainer_name' => 'Charles Hills',
                    'trainer_country_code' => 'GB',
                    'trainer_country_desc' => 'Great Britain',
                    'owner_group_uid' => 5,
                    'owner_uid' => 12,
                    'owner_name' => 'Sheikh Juma Dalmook Al Maktoum',
                ]
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
