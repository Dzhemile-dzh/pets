<?php

declare(strict_types=1);

namespace Bo\AdPrompts;

use Bo\BetPrompts;
use Bo\Results;
use Bo\Standart;
use Api\DataProvider\Bo\AdPrompts\NextRace as DataProvider;
use \Api\Input\Request\Horses\Results\FastByRace as ResultRequest;
use Phalcon\Mvc\Model\Row;

/**
 * Class NextRace
 * @package Bo\AdPrompts
 */
class NextRace extends Standart
{
    /**
     * @return array
     * @throws \Api\Exception\InternalServerError
     * @throws \Api\Exception\ValidationError
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     * @throws \Exception
     */
    public function getData(): array
    {
        $raceDetails = $this->getRaceDetails();

        //the race Id here represents the next race according to current time.
        $raceId = $raceDetails->race_instance_uid;

        $boRaceCards = new \Bo\RaceCards($this->request);
        $keyStat = $this->getKeyStat($boRaceCards, $raceId);
        $spotlightSelection = $this->getSpotlightSelection($boRaceCards, $keyStat, $raceId);
        $recentRaceId = $this->getLastRecentRace();
        $boResults = new Results(new ResultRequest([], [$recentRaceId]));

        return [
            'race_details' => $raceDetails,
            'most_tipped' => $this->getMostTipped($raceId),
            'spotlight_selection' => $spotlightSelection,
            'key-stat' => $keyStat,
            'latest_results' => $boResults->getFastByRaceResult(),
        ];
    }

    /**
     * @return Row
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    private function getRaceDetails(): Row
    {
        return (new DataProvider())->getNextRace();
    }

    /**
     * @return int|null
     * @throws \Exception
     */
    private function getLastRecentRace(): ?int
    {
        return (new DataProvider())->getLastRecentRace();
    }

    /**
     * @param \bo\RaceCards $bo
     *
     * @return array
     */
    private function getKeyStat(\bo\RaceCards $bo, $raceId): array
    {
        return $bo->retrieveVerdict($raceId);
    }

    /**
     * @param \bo\RaceCards $bo
     * @param array         $keyStat
     *
     * @return array
     */
    private function getSpotlightSelection(\bo\RaceCards $bo, array $keyStat, $raceId): ?\Api\Row\Horse
    {
        $result = $bo->getSpotlightVerdictSelection($raceId);
        if ($result) {
            $result->writeAttribute('spotlight_text', $keyStat[0]['rp_verdict']);
        }
        return ($result) ? (object) $result : null;
    }

    /**
     * @param int $raceId
     *
     * @return array
     * @throws \Api\Exception\ValidationError
     */
    private function getMostTipped(int $raceId): ?array
    {
        $request = new \Api\Input\Request\Horses\BetPrompts\Index(['raceId' => $raceId]);
        $bo = new BetPrompts($request);
        $result = $bo->getBetPrompts();
        return ($result->most_tipped) ? array_values($result->most_tipped) : null;
    }
}
