<?php

namespace Api\Result\RaceCards\Trainerspot;

/**
 * Class RaceTrace
 *
 * @package Api\Result\RaceCards\Trainerspot
 */
class RaceTrace extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'trainerspot.race_trace' => '\Api\Output\Mapper\RaceCards\Trainerspot\RaceTrace\Course',
            'trainerspot.race_trace.trainers' => '\Api\Output\Mapper\RaceCards\Trainerspot\RaceTrace\Trainers',
            'trainerspot.race_trace.trainers.stats' => '\Api\Output\Mapper\RaceCards\Trainerspot\RaceTrace\Stats',
        ];
    }
}
