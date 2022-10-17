<?php

namespace Bo\RaceCards\Trainerspot;

use Bo\Standart;
use \Api\Input\Request as InputRequest;

/**
 * Class Form
 *
 * @package Bo\RaceCards\Trainerspot
 */
class Form extends Standart
{
    /**
     * Form constructor.
     *
     * @param InputRequest\HorsesRequest $request
     */
    public function __construct(InputRequest\HorsesRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\RaceCards\Trainer
     */
    protected function getModelTrainer()
    {
        return new \Models\Bo\RaceCards\Trainer();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Bo\Profile\Trainer
     */
    protected function getBoTrainerProfile($request)
    {
        return new \Bo\Profile\Trainer($request, false);
    }

    /**
     * @param $request
     *
     * @return array
     */
    public function getForm($request)
    {
        $trainers = [];
        $trainersRaces = $this->getModelTrainer()->getTrainerspot($request);

        foreach ($trainersRaces as $races) {
            if (count($races) >= 5) {
                $trainers[] = $this->aggregateTrainerspot($races, $request);
            }
        }

        usort($trainers, [$this, $request->getRequestType() == 'out-of-form' ? 'sortDescTrainers' : 'sortAscTrainers']);

        return $trainers;
    }

    /**
     * Function sorts array of races in DESC order by running_to_form.
     *
     * @param object $raceA
     * @param object $raceB
     *
     * @return int comparison result
     */
    private function sortDescTrainers($raceA, $raceB)
    {
        if ($raceA->running_to_form == $raceB->running_to_form) {
            return 0;
        }
        return $raceA->running_to_form > $raceB->running_to_form ? 1 : -1;
    }

    /**
     * Function sorts array of races in ASC order by running_to_form.
     *
     * @param object $raceA
     * @param object $raceB
     *
     * @return int comparison result
     */
    private function sortAscTrainers($raceA, $raceB)
    {
        if ($raceA->running_to_form == $raceB->running_to_form) {
            return 0;
        }
        return $raceA->running_to_form < $raceB->running_to_form ? 1 : -1;
    }

    /**
     * @param $races
     * @param $request
     *
     * @return object
     */
    public function aggregateTrainerspot($races, $request)
    {
        $trainerBo = $this->getBoTrainerProfile($request);
        $runs = count($races);
        $wins = 0;

        /*
         * Make empty 14days array
         * */
        $last14DaysFinPos = array_fill_keys(range(14, 1, -1), null);

        foreach ($races as $row) {
            if ($row->days_ago > 0) {
                $last14DaysFinPos[$row->days_ago] .= $row->race_outcome_position > 6 && $row->race_outcome_position < 10
                    ? $row->race_outcome_position : $row->race_outcome_form_char;
            }

            if ($row->race_outcome_position == 1) {
                ++$wins;
            }
        }

        $runningForm = $trainerBo->getRunningToForm(null, $races);
        return \Api\Row\RaceCards\Trainerspot::createFromArray(
            [
                'trainer_uid' => $row->trainer_uid,
                'trainer_style_name' => $row->style_name,
                'runs' => $runs,
                'wins' => $wins,
                'last14_days_fin_pos' => $last14DaysFinPos,
                'running_to_form' => current($runningForm)
            ]
        );
    }
}
