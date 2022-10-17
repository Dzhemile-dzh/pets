<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\RaceCards;

class StableToursDatabase extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'stable_tours_database' => '\Api\Output\Mapper\RaceCards\StableToursDatabase'
        ];
    }
}
