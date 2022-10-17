<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 2/11/2016
 * Time: 12:22 PM
 */

namespace Api\Output\Mapper\CourseProfile\Statistics;

class TopHorses extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)style_name,country_origin_code' => 'style_name',
            'wins' => 'wins',
            'runs' => 'runs',
            '(getPercent)wins,runs' => 'win_percent',
            'trainer_uid' => 'trainer_uid',
            'trainer_name' => 'trainer_name',
            'top_rpr' => 'top_rpr',
            '(getStake)stake' => 'stake'
        ];
    }
}
