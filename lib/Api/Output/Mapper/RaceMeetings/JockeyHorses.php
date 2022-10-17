<?php

namespace Api\Output\Mapper\RaceMeetings;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class JockeyHorses
 *
 * @package Api\Output\Mapper\RaceMeetings\JockeyHorses
 */
class JockeyHorses extends HorsesMapper
{

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            'horse_name' => 'horse_name',
            'saddle_cloth_no' => 'saddle_cloth_no',
            'jockey_uid' => 'jockey_uid',
            'jockey_name' => 'jockey_name',
            'weight_allowance_lbs' => 'weight_allowance_lbs',
            'previous_jockeys' => 'previous_jockeys'
        ];
    }
}
