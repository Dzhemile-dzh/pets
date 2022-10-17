<?php

namespace Tests\Stubs\Models\Bo\RaceCards;

class Jockey extends \Tests\Stubs\Models\Jockey
{
    /**
     * @param $raceId
     *
     * @return array
     * @throws \Exception
     */
    public function getJockeyIdsForStatistics($raceId)
    {
        $data = [
            614973 => [78935, 78252, 14522, 83607, 92186, 84857, 91144, 78224, 89627, 84882, 90953]
        ];

        return $data[$raceId];
    }
}
