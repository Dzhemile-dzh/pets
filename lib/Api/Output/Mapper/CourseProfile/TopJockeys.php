<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 6/1/2016
 * Time: 11:50 AM
 */

namespace Api\Output\Mapper\CourseProfile;

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
            '(getStake)stake' => 'stake'
        ];
    }
}
