<?php

namespace Bo;

use Api\Constants\Horses as Constants;
use Api\Input\Request\HorsesRequest;

/**
 * Class TotePredictor
 *
 * @package Bo
 */
abstract class TotePredictor extends Standart
{
    /**
     * @return \Api\DataProvider\Bo\TotePredictor
     */
    abstract public function getDataProvider();

    /**
     * @codeCoverageIgnore
     *
     * @param HorsesRequest $request
     *
     * @return BetPrompts
     */
    protected function getBetPrompts($request)
    {
        return new \Bo\BetPrompts($request);
    }

    /**
     * @codeCoverageIgnore
     *
     * @param HorsesRequest $request
     *
     * @return BetPrompts\Signposts
     */
    protected function getSignposts($request)
    {
        return new \Bo\BetPrompts\Signposts($request);
    }

    /**
     * Get Tote Predictor races
     *
     * @return array|null
     */
    protected function getRaces()
    {
        $provider = $this->getDataProvider();

        return $provider->getTotePredictorRaces($this->getRequest());
    }

    /**
     * @param       $races
     * @param array $funcFilter
     *
     * @return array|null
     */
    protected function addRunners($races, $funcFilter)
    {
        $result = null;

        if (isset($races)) {
            $provider = $this->getDataProvider();
            $runners = $provider->getTotePredictorRunners($this->getRequest());

            foreach ($races as $race) {
                if (isset($race) && isset($race->race_instance_uid)) {
                    $race->runners = $runners[$race->race_instance_uid]->runners;

                    if (!empty($race->runners)) {
                        $runnersPositions = $provider->getLastRunPositions(array_keys($race->runners));

                        $this->addLastRunPositions($race->runners, $runnersPositions);
                        $this->addBetPromptScores($race->runners, $race->race_instance_uid);

                        $this->getFinalScoring($race->runners, 'score', 'conditions_score');
                        $this->getFinalScoring($race->runners, 'rp_postmark', 'rpr_score');
                        $this->getFinalScoring($race->runners, 'form', 'form_score');
                        $this->getFinalScoring($race->runners, 'bet_prompt_score', 'trainer_jockey_score');

                        $this->addTotalScore($race->runners);
                        $this->addPredictedPosition($race->runners);

                        usort(
                            $race->runners,
                            function ($a, $b) {
                                if ($b->total_score == $a->total_score) {
                                    return 0;
                                }

                                return ($b->total_score < $a->total_score) ? -1 : 1;
                            }
                        );
                    } else {
                        $race->runners = null;
                    }

                    if (!empty($funcFilter) && is_callable($funcFilter)) {
                        call_user_func_array($funcFilter, [&$race]);
                    }

                    $result[] = $race;
                }
            }
        }

        return $result;
    }

    /**
     * @param $race
     */
    protected function getFilteredRunners(&$race)
    {
        $cnt = !is_null($race->runners) ? count($race->runners) : 0;
        if ($cnt > 0 && $cnt <= 4) {
            $race->runners = array_slice($race->runners, 0, 1);
        } elseif ($cnt >= 5 && $cnt <= 7) {
            $race->runners = array_slice($race->runners, 0, 2);
        } elseif (($cnt >= 8 && $cnt <= 15)
            || ($cnt >= 16 && strpos(Constants::RACE_GROUP_CODE_HANDICAP, $race->race_group_code) === false)
        ) {
            $race->runners = array_slice($race->runners, 0, 3);
        } elseif ($cnt >= 16 && strpos(Constants::RACE_GROUP_CODE_HANDICAP, $race->race_group_code) !== false) {
            $race->runners = array_slice($race->runners, 0, 4);
        }
    }

    /**
     * @param array  $runners
     * @param string $baseScore
     * @param string $finalScore
     */
    protected function getFinalScoring(&$runners, $baseScore, $finalScore)
    {
        $maxScore = 0;
        array_walk(
            $runners,
            function ($item) use (&$maxScore) {
                if ($item->non_runner != 'Y') {
                    $maxScore++;
                }
            }
        );

        if ($maxScore == 0) {
            return;
        }

        usort(
            $runners,
            function ($a, $b) use ($baseScore) {
                return $b->{$baseScore} == $a->{$baseScore} ? 0 : $b->{$baseScore} > $a->{$baseScore} ? 1 : -1;
            }
        );

        $currentScore = $runners[0]->{$baseScore};
        $maxCount = 0;
        foreach ($runners as $runner) {
            if ($runner->non_runner == 'Y') {
                $runner->{$finalScore} = 0;
                continue;
            }

            if ($currentScore != $runner->{$baseScore}) {
                $currentScore = $runner->{$baseScore};
                $maxScore -= $maxCount;
                $maxCount = 1;
            } else {
                $maxCount++;
            }

            $runner->{$finalScore} = $runner->{$baseScore} == 0 ? 0 : $maxScore;
        }
    }

    /**
     * @param array $runners
     * @param array $runnersLastPos
     */
    private function addLastRunPositions(&$runners, $runnersLastPos)
    {
        foreach ($runnersLastPos as $runner) {
            switch ($runner->last_pos) {
                case 1:
                    $runners[$runner->horse_uid]->form += 5;
                    break;
                case 2:
                    $runners[$runner->horse_uid]->form += 4;
                    break;
                case 3:
                    $runners[$runner->horse_uid]->form += 3;
                    break;
                case 4:
                    $runners[$runner->horse_uid]->form += 2;
                    break;
                case 5:
                    $runners[$runner->horse_uid]->form += 1;
                    break;
                default:
                    break;
            }
        }
    }

    /**
     * @param array $runners
     */
    private function addTotalScore(&$runners)
    {
        foreach ($runners as $key => $runner) {
            $runners[$key]->total_score =
                $runner->rpr_score
                + $runner->conditions_score
                + $runner->trainer_jockey_score
                + $runner->form_score;
        }
    }

    /**
     * @param array $runners
     */
    private function addPredictedPosition(&$runners)
    {
        usort($runners, [$this, 'sortByPredictedPosition']);

        $predictedPosition = 1;

        foreach ($runners as $runner) {
            if ($runner->non_runner === 'Y') {
                $runner->predicted_position = null;
                continue;
            }
            $runner->predicted_position = $predictedPosition;
            $predictedPosition++;
        }
    }

    /**
     * Compare function for sorting runners by prioritized fields.
     * If 1st field for both runners are equal then compare runners by next field.
     * If runners are equal by all fields then runners are totally equal.
     *
     * @param int   $runner1
     * @param int   $runner2
     * @param array $fields
     *
     * @return int
     */
    private function sortByPredictedPosition(
        $runner1,
        $runner2,
        $fields = [
            'total_score',
            'form_score',
            'rpr_score',
            'trainer_jockey_score',
            'conditions_score',
            'saddle_cloth_no',
        ]
    ) {
        // see PHPDoc
        $result = 0;
        foreach ($fields as $property) {
            if ($runner1->$property === $runner2->$property) {
                continue;
            }
            $result = $runner1->$property > $runner2->$property ? -1 : 1;
            break;
        }

        return $result;
    }

    /**
     * Add bet prompt scores to runners
     *
     * @param          $runners
     * @param null|int $raceId
     */
    private function addBetPromptScores(&$runners, $raceId = null)
    {
        $betPrompts = $this->getBetPrompts($this->getRequest());
        $signpostsBo = $this->getSignposts($this->getRequest());
        if (!$this->getRequest()->isParameterProvided('raceId')) {
            $signpostsBo->setRaceId($raceId);
        }
        $signpostsBo->setBetPromts($betPrompts);

        $hotTrainers = $signpostsBo->getHotTrainers();
        $hotJockeys = $signpostsBo->getHotJockeys();
        $trainersJockeys = $signpostsBo->getTrainersJockeys();
        $courseJockeys = $signpostsBo->getCourseJockeys();
        $courseTrainers = $signpostsBo->getCourseTrainers();

        foreach ($runners as $key => $runner) {
            $score = $this->getHotScore($hotTrainers, $runner->horse_uid)
                + $this->getHotScore($hotJockeys, $runner->horse_uid)
                + $this->getHotScore($trainersJockeys, $runner->horse_uid)
                + $this->getHotScore($courseJockeys, $runner->horse_uid)
                + $this->getHotScore($courseTrainers, $runner->horse_uid);

            if ($score > 50) {
                $score = 50;
            }
            $runners[$key]->bet_prompt_score = $score;
        }
    }

    /**
     * @param array $statsData
     * @param int   $horseId
     *
     * @return int
     */
    private function getHotScore($statsData, $horseId)
    {
        $score = 0;

        if (empty($statsData)) {
            return $score;
        }

        foreach ($statsData as $item) {
            if (isset($item->bet_prompt_score)) {
                foreach ($item->entries as $horse) {
                    if (isset($horse->horse_uid) && $horse->horse_uid == $horseId) {
                        $score = $item->bet_prompt_score;
                        break;
                    }
                }
            } elseif (isset($item->jockeys)) {
                $score = $this->getHotScore($item->jockeys, $horseId);
                if ($score > 0) {
                    break;
                }
            } elseif (isset($item->trainers)) {
                $score = $this->getHotScore($item->trainers, $horseId);
                if ($score > 0) {
                    break;
                }
            }
        }

        return $score;
    }
}
