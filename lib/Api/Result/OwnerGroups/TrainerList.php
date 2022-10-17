<?php

namespace Api\Result\OwnerGroups;

use Api\Result\Json as Result;

/**
 * Class TrainerList
 * @package Api\Result\OwnerGroups
 */
class TrainerList extends Result
{
    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'trainer_list' => 'Api\Output\Mapper\OwnerGroups\TrainerList',
            'trainer_list.trainer_country' => 'Api\Output\Mapper\OwnerGroups\TrainerListTrainerCountry',
            'trainer_list.trainer_owners' => 'Api\Output\Mapper\OwnerGroups\TrainerListTrainerOwners'
        ];
    }
}
