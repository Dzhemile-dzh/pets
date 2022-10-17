<?php

namespace Api\Output\Mapper\RaceCards;

use \Api\Output\Mapper\HorsesMapper;

/**
 * Class PostPointerComments
 *
 * @package Api\Output\Mapper\RaceCards
 */
class PostPointerComments extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(fixAroHorseName)horse_name,country_origin_code' => 'horse_name',
            'horse_id' => 'horse_id',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'saddle_cloth_no' => 'saddle_cloth_no',
            'diomed' => 'diomed',
        ];
    }
}
