<?php

namespace Api\Output\Mapper\LookupTable;

/**
 * @package Api\Output\Mapper\LookupTable
 */
class RaceGroup extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @inheritdoc
     */
    protected function getMap()
    {
        return [
            'race_group_uid' => 'race_group_uid',
            'race_group_code' => 'race_group_code',
            'race_group_desc' => 'race_group_desc',
        ];
    }
}
