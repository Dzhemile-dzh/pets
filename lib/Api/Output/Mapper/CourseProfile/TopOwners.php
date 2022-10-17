<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 7/13/2016
 * Time: 3:23 PM
 */

namespace Api\Output\Mapper\CourseProfile;

use RP\Util\Math\GetPercent;
use Api\Row\Methods\GetStake;

class TopOwners extends \Api\Output\Mapper\HorsesMapper
{
    use GetPercent;
    use GetStake;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'owner_uid' => 'owner_uid',
            'owner_name' => 'owner_name',
            'style_name' => 'owner_style_name',
            'ptp_type_code' => 'ptp_type_code',
            'no_of_runs' => 'rides',
            'no_of_wins' => 'wins',
            '(getPercent)no_of_wins,no_of_runs' => 'win_percentage',
            '(getStake)stake' => 'stake'
        ];
    }
}
