<?php

namespace Bo;

use Api\Constants\Horses as Constants;
use Api\DataProvider\Bo\RaceMeetings\DailyRaceMeetings as DataProvider;
use Models\Bo\RaceCards\RaceInstance;

/**
 * Class DailyRaceMeetings
 *
 * @package Bo
 */
class DailyRaceMeetings extends Standart
{
    /**
     * @var \Api\Input\Request\Horses\RaceMeetings\DailyRaceMeetings
     */
    protected $request;

    /**
     * @return DataProvider
     */
    protected function getDataProvider()
    {
        return new DataProvider();
    }

    /**
     * @return RaceCards\Runners
     * @throws \Api\Exception\InternalServerError
     */
    protected function getRaceCardsRunnersBo()
    {
        return new RaceCards\Runners($this->request);
    }

    /**
     * @return RaceInstance|\Models\RaceInstance
     */
    protected function getModelRaceInstance()
    {
        return new RaceInstance();
    }

    /**
     * @return array
     * @throws \Api\Exception\InternalServerError
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getMeetings()
    {
        $meetings = $this->getDataProvider()->getDailyMeetings($this->request->getMeetingDate());

        $allRaceIds = array_reduce(
            $meetings,
            function ($allRaceIds, $meeting) {
                return array_merge($allRaceIds, array_keys($meeting['races']));
            },
            []
        );

        if (empty($allRaceIds)) {
            return $meetings;
        }

        // race meeting endpoint should have exact same fields are racaCards runners
        // that is why we can use race card runners bo to get information for all runners in already founded races
        $raceCardsBo = $this->getRaceCardsRunnersBo();

        // We need to provide request here too because of a trainer profile bo. It's constructor requires request param.
        $runners = $raceCardsBo->getRunnersInfo($allRaceIds, $this->request, false);
        $raceInstanceModel = $this->getModelRaceInstance();
        $fastResultRaces = $raceInstanceModel->checkFastResults($this->request->getMeetingDate());
        $runnersCount = $this->getDataProvider()->getNoOfRunnersPerRace($allRaceIds);
        $performRacePerRaceId = $this->getDataProvider()->getPerformRace($allRaceIds);
        $raceAttribPerRaceId = $this->getDataProvider()->getRacesAttributes($allRaceIds);

        //We create some hash table for easily distribute runners in races without using 3 nested loops
        $runnersPerCourseRace = [];
        foreach ($runners as $horseId => $runner) {
            $runnersPerCourseRace[$runner->course_uid][$runner->race_instance_uid][$horseId] = $runner;
        }

        // We need to iterate all races to add runners and some other extra fields that are not calculated in SQL
        // like if there is fast_result, max performance value and calculated runners count.
        // If there is a finished race in the meeting we should raise a flag to show it.
        foreach ($meetings as $courseId => $meeting) {
            $hasFinishedGBIRE = 0;
            $hasFinishedRace = 0;
            foreach ($meeting['races'] as $raceId => $race) {
                $race->race_runners = $runnersPerCourseRace[$courseId][$raceId];

                if ($race->race_status_code == Constants::RACE_STATUS_RESULTS_STR) {
                    $hasFinishedRace = 1;
                    if (in_array($meeting->country_code, Constants::COUNTRIES_GB_IRE) &&
                    $race->formbook_yn == 'Y') {
                        $hasFinishedGBIRE = 1;
                    }
                }
                if (isset($fastResultRaces[$raceId])) {
                    $race->fast_result = 1;
                }
                $race->count_runners = intval($runnersCount[$raceId]->runners_count);

                $race->no_of_runners = $runnersCount[$raceId]->no_of_runners > 0 ? $runnersCount[$raceId]->no_of_runners : $race->no_of_runners;


                $race->surface = $raceAttribPerRaceId[$raceId]['attribs']['Surface']['race_attrib_desc'] ?? null;

                $raceClassName = Constants::RACE_CLASS_STR;
                if ($meeting->country_code == Constants::COUNTRY_GB) {
                    $raceClassName = Constants::RACE_CLASS_SUB_STR;
                }

                $race->race_class = $raceAttribPerRaceId[$raceId]['attribs'][$raceClassName]['race_attrib_desc'] ?? null;

                // In Dataprovider we create a Hash map for easily finding max_performance to avoid more loops
                // We set the max_performance value for ruk to key `2` in performance array and for atr on key `1`
                $race->perform_race_uid_atr = $performRacePerRaceId[$raceId]->performance[1]->max_performance ?? null;
                $race->perform_race_uid_ruk = $performRacePerRaceId[$raceId]->performance[2]->max_performance ?? null;
            }
            $meeting->finished_gb_ire_race = $hasFinishedGBIRE;
            $meeting->finished_race = $hasFinishedRace;
        }

        return $raceCardsBo->getList($this->request->getMeetingDate(), false, $meetings);
    }
}
