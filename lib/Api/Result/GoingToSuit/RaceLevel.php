<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/30/2016
 * Time: 4:40 PM
 */

namespace Api\Result\GoingToSuit;

class RaceLevel extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'race_level' => '\Api\Output\Mapper\GoingToSuit\RaceLevel',
        ];
    }
}
