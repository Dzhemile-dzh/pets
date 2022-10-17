<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\RaceCards;

class Topspeed extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'topspeed' => '\Api\Output\Mapper\RaceCards\Topspeed\Topspeed',
            'topspeed.race_details' => '\Api\Output\Mapper\RaceCards\Topspeed\RaceDetails',
            'topspeed.runners' => '\Api\Output\Mapper\RaceCards\Topspeed\Runners',
            'topspeed.runners.best_topspeed.last_year' => '\Api\Output\Mapper\RaceCards\Topspeed\LastYear',
            'topspeed.runners.best_topspeed.going' => '\Api\Output\Mapper\RaceCards\Topspeed\Going',
            'topspeed.runners.best_topspeed.distance' => '\Api\Output\Mapper\RaceCards\Topspeed\Distance',
            'topspeed.runners.best_topspeed.course' => '\Api\Output\Mapper\RaceCards\Topspeed\Course',
            'topspeed.runners.last6ratings' => '\Api\Output\Mapper\RaceCards\Topspeed\Last6Ratings',
            'topspeed_selection' => '\Api\Output\Mapper\RaceCards\Topspeed\TopspeedSelection'
        ];
    }
}
