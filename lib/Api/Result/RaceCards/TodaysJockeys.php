<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 11/22/2016
 * Time: 1:27 PM
 */

namespace Api\Result\RaceCards;

class TodaysJockeys extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'todays_jockeys' => '\Api\Output\Mapper\RaceCards\TodaysJockeys'
        ];
    }
}
