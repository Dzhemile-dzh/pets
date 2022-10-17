<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 2/11/2016
 * Time: 12:22 PM
 */

namespace Api\Output\Mapper\CourseProfile\Statistics;

class TopOwners extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'owner_uid' => 'owner_uid',
            'style_name' => 'style_name',
            'wins' => 'wins',
            'runs' => 'runs',
            '(getPercent)wins,runs' => 'win_percent',
            '(getStake)stake' => 'stake',
            'ptp_type_code' => 'ptp_type_code'
        ];
    }
}
