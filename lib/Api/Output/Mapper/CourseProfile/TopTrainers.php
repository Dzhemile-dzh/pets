<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 6/7/2016
 * Time: 4:07 PM
 */

namespace Api\Output\Mapper\CourseProfile;

use RP\Util\Math\GetPercent;
use Api\Row\Methods\GetStake;

class TopTrainers extends \Api\Output\Mapper\HorsesMapper
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
            'no_of_runs' => 'rides',
            'no_of_wins' => 'wins',
            '(getPercent)no_of_wins,no_of_runs' => 'win_percentage',
            '(getStake)stake' => 'stake'
        ];
    }
}
