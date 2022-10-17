<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 7/6/2016
 * Time: 4:59 PM
 */

namespace Api\Output\Mapper\RaceCards\TenYearTrends;

class Favourites extends \Api\Output\Mapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'wins' => 'wins',
            'races' => 'races',
            'stake' => 'stake',
        ];
    }
}
