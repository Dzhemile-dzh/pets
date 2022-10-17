<?php

declare(strict_types=1);

namespace Api\Result\AdPrompts;

use Api\Input\Request\Horses\AdPrompts\NextRace as Request;
use Api\Result\Xml as Result;

/**
 * Class NextRace
 * @package Api\Result\AdPrompts
 */
class NextRace extends Result
{
    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'race_details' => 'Api\Output\Mapper\AdPrompts\NextRace\RaceDetails',
            'most_tipped' => 'Api\Output\Mapper\AdPrompts\NextRace\MostTipped',
            'spotlight_selection' => 'Api\Output\Mapper\AdPrompts\NextRace\SpotlightSelection',
            'key-stat' => 'Api\Output\Mapper\AdPrompts\NextRace\KeyStat',
            'latest_results' => 'Api\Output\Mapper\AdPrompts\NextRace\LatestResults',
        ];
    }
}
