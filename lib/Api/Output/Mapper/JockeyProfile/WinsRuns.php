<?php

namespace Api\Output\Mapper\JockeyProfile;

/**
 * Class WinsRuns
 *
 * @package Api\Output\Mapper\JockeyProfile
 */
class WinsRuns extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            "runs" => "runs",
            "wins" => "wins",
            "(getPercent)wins,runs" => "percent",
        ];
    }
}
