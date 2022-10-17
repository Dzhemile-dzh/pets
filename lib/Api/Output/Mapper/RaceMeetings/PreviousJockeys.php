<?php

namespace Api\Output\Mapper\RaceMeetings;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class PreviousJockeys
 *
 * @package Api\Output\Mapper\RaceMeetings\PreviousJockeys
 */
class PreviousJockeys extends HorsesMapper
{

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'old_jockey_uid' => 'jockey_uid',
            'old_jockey_name' => 'jockey_name',
            '(dateISO8601)change_date' => 'jockey_change_date_time'
        ];
    }
}
