<?php

namespace Api\Output\Mapper\RaceMeetings;

use Api\Row\Methods\GetStake;
use RP\Util\Math\GetPercent;

class TopJockeys extends \Api\Output\Mapper\HorsesMapper
{
    use GetPercent;
    use GetStake;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'jockey_uid' => 'jockey_uid',
            'jockey_name' => 'jockey_name',
            'style_name' => 'jockey_style_name',
            'ptp_type_code' => 'ptp_type_code',
            'no_of_runs' => 'rides',
            'no_of_wins' => 'wins',
            '(getPercent)no_of_wins,no_of_runs' => 'win_percentage',
            '(getStake)stake' => 'stake',
            'trainer_name_most_wins' => 'trainer_name_most_wins',
            'no_trainer_jockey_wins' => 'trainer_jockey_wins',
            'no_trainer_jockey_runs' => 'trainer_jockey_runs',
            '(getPercent)no_trainer_jockey_wins,no_trainer_jockey_runs' => 'trainer_jockey_win_percentage',
            'course_ride_since_win' => 'course_ride_since_win'
        ];
    }
}
