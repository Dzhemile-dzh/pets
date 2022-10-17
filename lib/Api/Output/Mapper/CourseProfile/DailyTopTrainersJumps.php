<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 6/7/2016
 * Time: 4:07 PM
 */

namespace Api\Output\Mapper\CourseProfile;

use Api\Row\Methods\GetStake;
use RP\Util\Math\GetPercent;

class DailyTopTrainersJumps extends \Api\Output\Mapper\HorsesMapper
{
    use GetPercent;
    use GetStake;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'trainer_uid' => 'trainer_uid',
            'trainer_name' => 'trainer_name',
            'style_name' => 'trainer_style_name',
            'ptp_type_code' => 'ptp_type_code',
            'no_of_runs' => 'runs',
            'no_of_wins' => 'wins',
            '(getPercent)no_of_wins,no_of_runs' => 'win_percentage',
            '(getStake)stake' => 'stake',
            'course_run_since_win' => 'course_run_since_win',
            'chase_handicap_wins' => 'chase_handicap_wins',
            'chase_handicap_runs' => 'chase_handicap_runs',
            'chase_non_handicap_wins' => 'chase_non_handicap_wins',
            'chase_non_handicap_runs' => 'chase_non_handicap_runs',
            'hurdle_handicap_wins' => 'hurdle_handicap_wins',
            'hurdle_handicap_runs' => 'hurdle_handicap_runs',
            'hurdle_non_handicap_wins' => 'hurdle_non_handicap_wins',
            'hurdle_non_handicap_runs' => 'hurdle_non_handicap_runs'
        ];
    }
}
