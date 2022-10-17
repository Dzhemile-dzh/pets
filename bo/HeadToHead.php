<?php

namespace Bo;

use Api\Constants\Horses as Constants;
use \Api\DataProvider\Bo\HeadToHead\HeadToHead as DataProvider;

class HeadToHead extends BoWithFigures
{
    /**
     * @var array
     */
    private $horseIds;

    /**
     * @var DataProvider
     */
    private $dataProvider;

    /**
     * HeadToHead constructor.
     * @param $horseIds
     */
    public function __construct($horseIds)
    {
        $this->horseIds = $horseIds;
        $this->dataProvider = new DataProvider();
    }

    public function getHeadToHead()
    {
        if (!empty($this->horseIds)) {
            $result = $this->dataProvider->getData($this->horseIds);
        }
        return !empty($result) ? $result : null;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getStatistics()
    {
        $flatFigures = $this->getFormForFigures($this->horseIds, Constants::RACE_TYPE_FLAT_ALIAS);
        $jumpsFigures = $this->getFormForFigures($this->horseIds, Constants::RACE_TYPE_JUMPS_ALIAS);

        $flatSeason = $this->getSeasonsForFigures(Constants::RACE_TYPE_FLAT_ALIAS);
        $jumpsSeason = $this->getSeasonsForFigures(Constants::RACE_TYPE_JUMPS_ALIAS);

        $statistics = $this->dataProvider->getStatistics($this->horseIds);
        foreach ($statistics as $horseUid => $data) {
            if (isset($flatFigures[$horseUid]) && !is_null($flatFigures[$horseUid])) {
                $data->flat_figures_calculated = $this->getFiguresArray($flatFigures[$horseUid], $flatSeason);
            }

            if (isset($jumpsFigures[$horseUid]) && !is_null($jumpsFigures[$horseUid])) {
                $data->jumps_figures_calculated = $this->getFiguresArray($jumpsFigures[$horseUid], $jumpsSeason);
            }
        }
        return !empty($statistics) ? $statistics : null;
    }

    public function getEntries()
    {
        $result = $this->dataProvider->getEntries($this->horseIds);
        return !empty($result) ? $result : null;
    }


    /**
     * @param $headToHeadRaces
     * @param $runners
     * @return array|null
     */
    public function getRaceCardsStats($headToHeadRaces, $runners)
    {
        if (!empty($runners)) {
            $runnersStats = $this->calculateRaceCardStats($headToHeadRaces, $runners);
        }
        return !empty($runnersStats) ? $runnersStats : null;
    }

    /**
     *  This method serves the purpose of calculating the statistics of head to head horses in a given race.
     *  The result should be an array with all horse numbers (saddle_cloth_no) from the race, showing how many times the given horses
     *  have previously beaten each other in a race.
     *
     * @param array $headToHeadRaces All races in which horses in the race have previously raced together.
     * @param array $runners All horses from the given race
     *
     * @return array
     */
    private function calculateRaceCardStats(array $headToHeadRaces, array $runners)
    {
        $result = [];
        $horseStats = [];
        $horseNumberStringPrefix = 'horse_number';

        uasort($runners, function ($runner1, $runner2) {
            return $runner1->horse_number <=> $runner2->horse_number;
        });

        // We need to create an array depending on the count of runners, to populate later, which shows
        // the horses stats for each horse_number in the race.
        foreach ($runners as $horse) {
            $horseNumber = $horseNumberStringPrefix . $horse->horse_number;
            $horseStats[$horseNumber] = 0;
        }

        // Assign each horse an array with all horse numbers in the race excluding the iterated horses own horse_number.
        // We should exclude the iterated horse because it will always be 0 as the given horse never beats itself in a race.
        foreach ($runners as $horse) {
            $horseNumber = $horseNumberStringPrefix . $horse->horse_number;
            $result[$horseNumber] = $horseStats;
            unset($result[$horseNumber][$horseNumber]);
        }

        // We need to loop all races where the horses from the current race have previously raced together.
        // Then we need to compare the race_outcome_code of those horses (runners) to determine which horse was in a better
        // position at the end of the race
        // Then we need to return the amount of times the horses have beaten each other in terms of the final race position
        foreach ($headToHeadRaces as $raceId => $race) {
            // To avoid manipulation of the data we are using for comparison,
            // we clone the $race->horses and do the manipulation there
            $raceRunners = $race->horses;

            foreach ($raceRunners as $horse1) {
                $firstHorseNumber = $horseNumberStringPrefix . $runners[$horse1->horse_uid]->horse_number;
                foreach ($raceRunners as $horse2) {
                    // here we avoid comparing the same horse.
                    if ($horse1->horse_uid === $horse2->horse_uid) {
                        continue;
                    }
                    $horse1raceOutcome = intval($horse1->race_outcome_code);
                    $horse2raceOutcome = intval($horse2->race_outcome_code);
                    $secondHorseNumber = $horseNumberStringPrefix . $runners[$horse2->horse_uid]->horse_number;

                    // If the horse has outcome of 0 a possible bug may be introduced as 0 comes before 1,
                    // so in that case the horse with outcome 0 will be displayed in first place, but
                    // actually the outcome 0 means that this horse did not finished at all.
                    // Total number of runners in a race never is greater than 40, so just to be safe
                    // we put a really big number here to make sure that the horse with outcome 0
                    // will always be displayed after the last finished horse.
                    if ($horse1raceOutcome === 0) {
                        $horse1raceOutcome = 400;
                    }

                    if ($horse2raceOutcome === 0) {
                        $horse2raceOutcome = 400;
                    }

                    if ($horse1raceOutcome < $horse2raceOutcome) {
                        $result[$firstHorseNumber][$secondHorseNumber]++;
                    } else {
                        if ($horse1raceOutcome > $horse2raceOutcome) {
                            $result[$secondHorseNumber][$firstHorseNumber]++;
                        }
                    }
                }
                // Unset the iterated horse to avoid duplicate iterations.
                unset($raceRunners[$horse1->horse_uid]);
            }
        }
        return $result;
    }
}
