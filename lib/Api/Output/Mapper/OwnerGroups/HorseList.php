<?php

namespace Api\Output\Mapper\OwnerGroups;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class HorseList
 *
 * @package Api\Output\Mapper\OwnerGroups
 */
class HorseList extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            'horse_uid' => 'horse_uid',
            'horse_name' => 'horse_name',
            'age' => 'age',
            '(trim)horse_country_origin_code' => 'horse_country_origin_code',
            'trainer_uid' => 'trainer_uid',
            'trainer_name' => 'trainer_name',
            '(trim)trainer_country_code' => 'trainer_country_code',
            'trainer_country_desc' => 'trainer_country_desc',
            'owner_uid' => 'owner_uid',
            'owner_name' => 'owner_name',
            '(dbYNFlagToBoolean)black_type' => 'black_type'
        ];
    }
}
