<?php

namespace Api\Output\Mapper\OwnerGroups;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class TrainerListTrainerCountry
 *
 * @package Api\Output\Mapper\OwnerGroups
 */
class TrainerListTrainerOwners extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            'owner_uid' => 'owner_uid',
            'owner_name' => 'owner_name',
            'owner_group_uid' => 'owner_group_uid'
        ];
    }
}
