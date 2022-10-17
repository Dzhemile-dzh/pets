<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 2/11/2016
 * Time: 12:21 PM
 */

namespace Api\Output\Mapper\CourseProfile\Statistics;

class TopTrainers extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'trainer_uid' => 'trainer_uid',
            'style_name' => 'style_name',
            'wins' => 'wins',
            'runs' => 'runs',
            '(getPercent)wins,runs' => 'win_percent',
            '(getStake)stake' => 'stake',
            'ptp_type_code' => 'ptp_type_code'
        ];
    }
}
