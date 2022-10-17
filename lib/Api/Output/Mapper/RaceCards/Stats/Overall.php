<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 11/17/2014
 * Time: 11:03 AM
 */
namespace Api\Output\Mapper\RaceCards\Stats;

class Overall extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'wins' => 'wins',
            'runs' => 'runs',
            '(GetPercent)wins,runs' => 'percent',
            '(stringToFloat)profit' => 'profit'
        ];
    }
}
