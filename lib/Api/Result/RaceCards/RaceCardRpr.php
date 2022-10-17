<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\RaceCards;

class RaceCardRpr extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'rpr' => '\Api\Output\Mapper\RaceCards\Rpr\Rpr',

            'rpr.race_details' => '\Api\Output\Mapper\RaceCards\Rpr\RaceDetails',
            'rpr.runners' => '\Api\Output\Mapper\RaceCards\Rpr\Runners',

            'rpr.runners.last_12_months' => '\Api\Output\Mapper\RaceCards\Rpr\Last12Months',
            'rpr.runners.going' => '\Api\Output\Mapper\RaceCards\Rpr\Going',
            'rpr.runners.distance' => '\Api\Output\Mapper\RaceCards\Rpr\Distance',
            'rpr.runners.course' => '\Api\Output\Mapper\RaceCards\Rpr\Course',
            'rpr.runners.last_races' => '\Api\Output\Mapper\RaceCards\Rpr\LastRace',
        ];
    }
}
