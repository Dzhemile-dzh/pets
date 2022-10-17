<?php

namespace Bo\RaceCards\Trainerspot;

use Bo\Standart;
use \Api\Input\Request as InputRequest;
use \Api\DataProvider\Bo\RaceCards\Trainerspot\RaceTrace as DataProvider;

/**
 * Class RaceTrace
 *
 * @package Bo\RaceCards\Trainerspot
 */
class RaceTrace extends Standart
{
    /**
     * RaceTrace constructor.
     *
     * @param InputRequest\HorsesRequest $request
     */
    public function __construct(InputRequest\HorsesRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @return \stdClass
     * @throws \Exception
     */
    public function getRaceTraceData()
    {
        $dataProvider = new DataProvider();
        $dataProvider->setRequest($this->getRequest());
        $dataProvider->populatePrevRacesTmpTable();

        $courses = $dataProvider->getCourseTrainerRaces();
        $stats = $dataProvider->getTrainerStats();
        $pastPerformances = $dataProvider->getTrainerPastPerformance();

        $raceTrace = [];
        foreach ($courses as $courseId => $course) {
            $courseData = clone ($course);
            $courseData->trainers = [];
            foreach ($course->trainers as $trainerId => $trainer) {
                foreach ($trainer->races as $raceId => $race) {
                    $trainerData = clone $trainer;
                    $trainerData->race_instance_uid = $raceId;
                    $trainerData->race_datetime = $race->race_datetime;
                    $trainerData->stats = (array_key_exists($trainerId, $stats)
                        && array_key_exists($raceId, $stats[$trainerId]['races']))
                        ? $stats[$trainerId]['races'][$raceId]
                        : null;
                    $trainerData->past_performance = (array_key_exists($trainerId, $pastPerformances)
                        && array_key_exists($raceId, $pastPerformances[$trainerId]['races']))
                        ? $this->getPastPerformance($pastPerformances[$trainerId]['races'][$raceId]['years'])
                        : null;
                    $trainerData->today_runners = ($race['horses']) ?? null;
                    $courseData->trainers[] = $trainerData;
                }
            }
            $raceTrace[] = $courseData;
        }

        $result = new \stdClass();
        $result->race_trace = $raceTrace;

        return $result;
    }

    /**
     * @param array $yearsData
     *
     * @return array
     */
    protected function getPastPerformance($yearsData)
    {
        $pastPerformance = [];
        foreach ($yearsData as $yearData) {
            $yearPerf = new \stdClass();
            $yearPerf->year = $yearData->race_year;
            $yearPerf->finishing_positions = '';
            foreach ($yearData->positions as $pos) {
                $yearPerf->finishing_positions .= (String)$pos->race_position;
            }
            $pastPerformance[] = $yearPerf;
        }
        return $pastPerformance;
    }
}
