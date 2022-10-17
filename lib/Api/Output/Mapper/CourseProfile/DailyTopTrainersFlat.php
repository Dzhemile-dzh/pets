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

class DailyTopTrainersFlat extends \Api\Output\Mapper\HorsesMapper
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
            'two_year_old_wins' => 'two_year_old_wins',
            'two_year_old_runs' => 'two_year_old_runs',
            '(getPercent)two_year_old_wins,two_year_old_runs' => 'two_year_old_win_percentage',
            'three_year_old_wins' => 'three_year_old_wins',
            'three_year_old_runs' => 'three_year_old_runs',
            '(getPercent)three_year_old_wins,three_year_old_runs' => 'three_year_old_win_percentage',
            'four_year_old_plus_wins' => 'four_year_old_plus_wins',
            'four_year_old_plus_runs' => 'four_year_old_plus_runs',
            '(getPercent)four_year_old_plus_wins,four_year_old_plus_runs' => 'four_year_old_plus_win_percentage',
            'course_run_since_win' => 'course_run_since_win',
            'two_year_old_handicap_wins' => 'two_year_old_handicap_wins',
            'two_year_old_handicap_runs' => 'two_year_old_handicap_runs',
            'two_year_old_non_handicap_wins' => 'two_year_old_non_handicap_wins',
            'two_year_old_non_handicap_runs' => 'two_year_old_non_handicap_runs',
            'three_year_old_handicap_wins' => 'three_year_old_handicap_wins',
            'three_year_old_handicap_runs' => 'three_year_old_handicap_runs',
            'three_year_old_non_handicap_wins' => 'three_year_old_non_handicap_wins',
            'three_year_old_non_handicap_runs' => 'three_year_old_non_handicap_runs',
        ];
    }
}
