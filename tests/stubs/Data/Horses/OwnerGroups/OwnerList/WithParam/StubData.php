<?php

namespace Tests\Stubs\Data\Horses\OwnerGroups\OwnerList\WithParam;

use UnitTestsComponents\Stubs\StubDataInterface;

/**
 * @package Tests\Stubs\Data\Horses\OwnerGroups\OwnerList\WithParam
 */
class StubData implements StubDataInterface
{
    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\OwnerGroups\OwnerList:47 ->getData()
            'dee33e5521a47efa8f19a4acd0202acd' => [
                [
                    'owner_group_uid' => 5,
                    'owner_group_lookup_uid' => 1,
                    'to_follow_uid' => 19,
                    'owner_uid' => 49845,
                    'owner_name' => 'Godolphin',
                ],
                [
                    'owner_group_uid' => 5,
                    'owner_group_lookup_uid' => 2,
                    'to_follow_uid' => 19,
                    'owner_uid' => 97229,
                    'owner_name' => 'Godolphin Racing LLC',
                ],
                [
                    'owner_group_uid' => 5,
                    'owner_group_lookup_uid' => 3,
                    'to_follow_uid' => 19,
                    'owner_uid' => 215481,
                    'owner_name' => 'Godolphin Racing LLC, Lessee',
                ],
                [
                    'owner_group_uid' => 5,
                    'owner_group_lookup_uid' => 4,
                    'to_follow_uid' => 19,
                    'owner_uid' => 218817,
                    'owner_name' => 'Godolphin Racing LLC, T Murray, P Braverman, H Clarke Et Al',
                ],
                [
                    'owner_group_uid' => 5,
                    'owner_group_lookup_uid' => 5,
                    'to_follow_uid' => 19,
                    'owner_uid' => 95175,
                    'owner_name' => 'Godolphin SNC',
                ],
                [
                    'owner_group_uid' => 5,
                    'owner_group_lookup_uid' => 6,
                    'to_follow_uid' => 19,
                    'owner_uid' => 223222,
                    'owner_name' => 'Godolphin SNC & Ballymore Thoroughbred Ltd',
                ],
                [
                    'owner_group_uid' => 5,
                    'owner_group_lookup_uid' => 39,
                    'to_follow_uid' => 19,
                    'owner_uid' => 224036,
                    'owner_name' => 'Godolphin & Prince A A Faisal',
                ],
                [
                    'owner_group_uid' => 5,
                    'owner_group_lookup_uid' => 40,
                    'to_follow_uid' => 19,
                    'owner_uid' => 229765,
                    'owner_name' => 'Godolphin & Partners',
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
