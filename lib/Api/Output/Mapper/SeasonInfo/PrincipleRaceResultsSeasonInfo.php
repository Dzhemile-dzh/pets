<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 12/24/2015
 * Time: 5:13 PM
 */

namespace Api\Output\Mapper\SeasonInfo;

class PrincipleRaceResultsSeasonInfo extends \Api\Output\Mapper\HorsesMapper
{
    protected function getMap()
    {
        return [
            'raceType' => 'race_type',
            'coursePrincipalSeason' => 'course_principal_season',
            'raceStatusType' => 'race_status_type'
        ];
    }
}
