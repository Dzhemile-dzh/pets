<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\SeasonalStatistics;

class TrainerJockeys extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'jockey_uid' => 'jockey_uid',
            'style_name' => 'jockey_style_name',
            'aka_style_name' => 'jockey_short_name',
            'wins' => 'wins',
            'rides' => 'rides',
            '(getPercent)wins,rides' => 'percent_wins_rides',
        ];
    }
}
