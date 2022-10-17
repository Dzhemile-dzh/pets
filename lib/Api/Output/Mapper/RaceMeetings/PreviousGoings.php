<?php

namespace Api\Output\Mapper\RaceMeetings;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class PreviousGoings
 *
 * @package Api\Output\Mapper\RaceMeetings\PreviousGoings
 */
class PreviousGoings extends HorsesMapper
{

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_going_history_uid' => 'race_going_history_uid',
            '(trim)h_going_type_code' => 'going_type_code',
            'h_going_type_desc' => 'going_type_desc',
            '(dateISO8601)going_change_date_time' => 'going_change_date_time'
        ];
    }
}
