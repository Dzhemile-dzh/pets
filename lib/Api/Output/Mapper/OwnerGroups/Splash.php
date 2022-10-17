<?php

namespace Api\Output\Mapper\OwnerGroups;

use Api\Output\Mapper\HorsesMapper;

/**
 * @package Api\Output\Mapper\OwnerGroups
 */
class Splash extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            'owner_group_lookup_uid' => 'owner_group_lookup_uid',
            'owner_group_uid' => 'owner_group_uid',
            'owner_group_splash_uid' => 'owner_group_splash_uid',
            'to_follow_uid' => 'to_follow_uid',
            'device_type' => 'device_type',
            'splash_url' => 'splash_url',
        ];
    }
}
