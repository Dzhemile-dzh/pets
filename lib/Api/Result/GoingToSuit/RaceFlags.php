<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 5/3/2017
 * Time: 12:07 PM
 */

namespace Api\Result\GoingToSuit;

class RaceFlags extends \Api\Result\Json
{
    protected function getMappers()
    {
        return [
            'race_flags' => '\Api\Output\Mapper\GoingToSuit\RaceFlags\Race',
            'race_flags.horses' => '\Api\Output\Mapper\GoingToSuit\RaceFlags\Horses',
        ];
    }
}
