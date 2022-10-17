<?php

namespace Api\Output\Mapper\OwnerGroups;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class HorseList
 *
 * @package Api\Output\Mapper\OwnerGroups
 */
class TrainerList extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            'trainer_uid' => 'trainer_uid',
            'trainer_name' => 'trainer_name',
            'trainer_country' => 'trainer_country',
            'trainer_owners' => 'trainer_owners'
        ];
    }
}
