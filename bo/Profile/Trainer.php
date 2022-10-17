<?php

namespace Bo\Profile;

use Api\Exception\ValidationError;

/**
 * Class Trainer Profile
 *
 * @package Bo\Profile
 */
class Trainer extends \Bo\Profile
{

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\TrainerProfile\RaceInstance
     */
    protected function getModelRaceInstance()
    {
        return new \Models\Bo\TrainerProfile\RaceInstance();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\TrainerProfile\HorseRace
     */
    protected function getModelHorseRace()
    {
        return new \Models\Bo\TrainerProfile\HorseRace();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\TrainerProfile\Statistics
     */
    protected function getModelStatistics()
    {
        return new \Models\Bo\TrainerProfile\Statistics();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\TrainerProfile\Trainer
     */
    protected function getModelTrainer()
    {
        return new \Models\Bo\TrainerProfile\Trainer();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Api\DataProvider\Bo\Profile\Trainer\DefaultInfo
     */
    public function getDataProviderDefaultInfo()
    {
        return new \Api\DataProvider\Bo\Profile\Trainer\DefaultInfo();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Selectors
     */
    protected function getModelSelectors()
    {
        return $this->getModelSelectorsForMan();
    }

    /**
     * @return array|null
     */
    public function getBigRaceWins()
    {
        $bigRaceWins = $this->getModelRaceInstance()->getBigRaceWins($this->request->getTrainerId());

        if (is_null($bigRaceWins)) {
            return null;
        }
        $this->addVideoDetails($bigRaceWins);

        return array_values($bigRaceWins);
    }

    /**
     * @return array|null
     */
    public function getLast14Days()
    {
        $races = $this->getModelRaceInstance()->getLast14Days($this->request->getTrainerId());

        if (is_null($races)) {
            return null;
        }

        $raceIds = array_map(
            function ($race) {
                return $race->race_instance_uid;
            },
            $races
        );

        return array_values(
            $this->combineRacesWithVideoDetails($races, $this->fetchVideoProvidersByRaceIds($raceIds))
        );
    }

    /**
     * @return array|null
     */
    public function getLast14DaysForm()
    {
        $trainer = $this->getModelTrainer()->getTrainer($this->request);
        if (!empty($trainer)) {
            return $this->getModelHorseRace()->getStatsLast14Days(
                $this->request->getTrainerId(),
                'trainer'
            );
        } else {
            return null;
        }
    }

    /**
     * @return object
     */
    public function getSinceAWin()
    {
        return (Object)$this->getModelRaceInstance()->getSinceAWin(
            $this->request->getTrainerId()
        );
    }

    /**
     *
     * @return array
     * @throws \Exception
     */
    public function getHorses()
    {
        return $this->getModelRaceInstance()->getHorses($this->request);
    }

    /**
     *
     * @return array
     * @throws \Exception
     */
    public function getStatisticalSummary()
    {
        return $this->getModelRaceInstance()->getStatisticalSummary($this->request);
    }

    /**
     * @return array
     */
    public function getEntries()
    {
        $entries = $this->getModelRaceInstance()->getEntries(
            $this->request->getTrainerId()
        );
        return empty($entries) ? null : $entries;
    }

    /**
     *
     * @return array
     * @throws \Exception
     */
    public function getStatistics()
    {
        $statistics = $this->getModelStatistics()->getStatistics(
            $this->request,
            $this->getModelSelectors()
        );
        return (!empty($statistics) && !empty($statistics['OVERALL']))
            ? $statistics : null;
    }

    /**
     * @return mixed
     */
    public function getTrainer()
    {
        $trainer = $this->getModelTrainer()->getTrainer($this->request);
        if (!empty($trainer)) {
            $trainer->trainer_last_14_days = $this->getModelHorseRace()
                ->getStatsLast14Days(
                    $this->request->getTrainerId(),
                    'trainer'
                );
            if (empty($trainer->trainer_last_14_days)) {
                $trainer->trainer_last_14_days = null;
            }

            $runningForm = $this->getRunningToForm([$this->request->getTrainerId()]);

            $trainer->running_to_form = $runningForm[$this->request->getTrainerId()] ?? null;

            $trainer->since_a_win = $this->getSinceAWin();
            return $trainer;
        } else {
            return null;
        }
    }

    /**
     * @param null $trainerIds
     * @param null $trainerRaces
     *
     * @return array
     */
    public function getRunningToForm($trainerIds = null, $trainerRaces = null)
    {
        if ($trainerIds && is_null($trainerRaces)) {
            $trainerRaces = $this->getModelHorseRace()->getRunningToForm(
                $trainerIds
            );
        } else {
            $trainerRaces = [['races' => $trainerRaces]];
        }

        $result = [];
        foreach ($trainerRaces as $trainerId => $races) {
            $runs = count($races['races']);
            $qualRuns = 0;
            foreach ($races['races'] as $row) {
                if ($row->race_outcome_position >= 6 && $row->race_outcome_position <= 10) {
                    $row->race_outcome_form_char = (string)$row->race_outcome_position;
                }
                $row->rp_postmark = $row->rp_postmark ?? 0;
                $row->rp_pre_postmark = $row->rp_pre_postmark ?? 0;
                $row->dist_to_winner = $row->dist_to_winner ?? 0;
                $row->race_group_uid = $row->race_group_uid ?? 0;
                $placed = false;
                $furlong = 0;
                if ($row->rp_pre_postmark == 0 || $row->rp_postmark == 0) {
                    if ($row->race_outcome_position == 1
                        || ($row->runners >= 5 && $row->runners <= 7
                            && $row->race_outcome_position == 2)
                        || ($row->runners > 8 && $row->race_outcome_position == 3)
                        || ($row->runners > 15 && $row->race_outcome_position == 4
                            && in_array(
                                $row->race_group_uid,
                                [5, 6, 11, 12, 13, 14, 15, 16]
                            ))
                    ) {
                        $placed = true;
                    } else {
                        if ($row->race_distance > 1760) {
                            $furlong = ($row->race_distance - 1760) / 220;
                        }
                        if ($row->dist_to_winner > 0
                            && (($row->dist_to_winner <= 6
                                    && $row->race_distance <= 1760)
                                || ($row->race_distance > 3520
                                    && $row->dist_to_winner <= (6 + $furlong * 0.5))
                                || ($row->race_distance >= 1430
                                    && $row->dist_to_winner == 3)
                                || ($row->race_distance >= 1431
                                    && $row->race_distance <= 1870
                                    && $row->dist_to_winner == 4)
                                || ($row->race_distance >= 1871
                                    && $row->race_distance <= 2750
                                    && $row->dist_to_winner == 5)
                                || ($row->race_distance >= 2751
                                    && $row->race_distance <= 3520
                                    && $row->dist_to_winner == 6)
                            )
                        ) {
                            $placed = true;
                        }
                    }
                }
                if (($row->rp_pre_postmark > 0 && $row->rp_postmark > 0
                        && ($row->rp_postmark - $row->rp_pre_postmark) >= -7)
                    || $placed
                    || $row->race_outcome_position == 1
                ) {
                    $qualRuns += 1;
                }
            }
            $result[$trainerId] = $runs != 0 ? $qualRuns / $runs * 100 : null;
        }
        return $result;
    }

    /**
     * @return \Phalcon\Mvc\ModelInterface
     * @throws ValidationError
     */
    protected function getTrainerData()
    {
        if (!isset($this->trainerData)) {
            $this->trainerData = $this->getModelTrainer()->getTrainer(
                $this->request
            );
            if (empty($this->trainerData)) {
                throw new ValidationError(8108);
            }
        }
        return $this->trainerData;
    }

    /**
     * @return array
     */
    public function getResults()
    {
        $races = $this->getModelRaceInstance()->getResults($this->request);

        if (is_null($races)) {
            return null;
        }
        $this->addVideoDetails($races);

        return $races;
    }
}
