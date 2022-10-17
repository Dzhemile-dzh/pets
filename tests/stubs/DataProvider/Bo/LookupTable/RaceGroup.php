<?php

namespace Tests\Stubs\DataProvider\Bo\LookupTable;

use Phalcon\Mvc\Model\Row\General;

/**
 * @package Tests\Stubs\DataProvider\Bo\HorseProfile
 */
class RaceGroup extends \Api\DataProvider\Bo\LookupTable\RaceGroup
{
    /**
     * @return array
     */
    public function getData()
    {
        return [
            General::createFromArray(
                [
                    'race_group_uid' => 0,
                    'race_group_code' => '0',
                    'race_group_desc' => 'Unknown',
                ]
            ),
            General::createFromArray(
                [
                    'race_group_uid' => 1,
                    'race_group_code' => '1',
                    'race_group_desc' => 'Group 1',
                ]
            ),
        ];
    }
}
