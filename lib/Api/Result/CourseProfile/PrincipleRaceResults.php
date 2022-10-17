<?php

namespace Api\Result\CourseProfile;

/**
 * Class PrincipleRaceResults
 *
 * @package Api\Result\CourseProfile
 */
class PrincipleRaceResults extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'principle_race_results' => '\Api\Output\Mapper\CourseProfile\PrincipleRaceResults',
            'principle_race_results.video_detail' => '\Api\Output\Mapper\CourseProfile\VideoDetail',
            'season_info' => '\Api\Output\Mapper\SeasonInfo\PrincipleRaceResultsSeasonInfo'
        ];
    }
}
