<?php

namespace Api\Output\Mapper\OwnerGroups;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class TrainerListTrainerCountry
 *
 * @package Api\Output\Mapper\OwnerGroups
 */
class TrainerListTrainerCountry extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            'code' => 'code',
            'desc' => 'desc'
        ];
    }
}
