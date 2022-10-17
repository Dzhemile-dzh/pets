<?php

namespace Api\Output\Mapper\OwnerGroups;

use Api\Output\Mapper\HorsesMapper;

/**
 * @package Api\Output\Mapper\OwnerGroups
 */
class OwnerList extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            'owner_group_uid' => 'owner_group_uid',
            'owner_group_lookup_uid' => 'owner_group_lookup_uid',
            'to_follow_uid' => 'to_follow_uid',
            'owner_uid' => 'owner_uid',
            'owner_name' => 'owner_name',
        ];
    }
}
