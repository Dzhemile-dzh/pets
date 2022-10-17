<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 10/06/14
 * Time: 3:35 AM
 */

namespace Api\Result\SeasonalStatistics;

class ChampionshipsAvailable extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'championships_available' => '\Api\Output\Mapper\SeasonalStatistics\ChampionshipsAvailable',
        ];
    }
}
