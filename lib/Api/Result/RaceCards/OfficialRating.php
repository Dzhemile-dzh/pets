<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\RaceCards;

class OfficialRating extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [

            'official_rating.race_details' => '\Api\Output\Mapper\RaceCards\OfficialRating\RaceDetails',
            'official_rating.runners' => '\Api\Output\Mapper\RaceCards\OfficialRating\Runners',
            'official_rating.runners.last_races' => '\Api\Output\Mapper\RaceCards\OfficialRating\LastRaces',
            'official_rating.runners.lifetime_high' => '\Api\Output\Mapper\RaceCards\OfficialRating\LifetimeHigh',
            'official_rating.runners.lifetime_low' => '\Api\Output\Mapper\RaceCards\OfficialRating\LifetimeLow',
            'official_rating.runners.annual_high' => '\Api\Output\Mapper\RaceCards\OfficialRating\AnnualHigh',
            'official_rating.runners.annual_low' => '\Api\Output\Mapper\RaceCards\OfficialRating\AnnualLow',
        ];
    }
}
