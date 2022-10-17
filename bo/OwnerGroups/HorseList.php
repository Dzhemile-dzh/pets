<?php

namespace Bo\OwnerGroups;

use Bo\Standart;
use Api\DataProvider\Bo\OwnerGroups\HorseList as DataProvider;
use Api\Input\Request\Horses\OwnerGroups\HorseList as Request;
use RP\Utils\Timer\Timer;

/**
 * Class HorseList
 *
 * @property Request $request
 *
 * @package Bo\OwnerGroups
 */
class HorseList extends BlackTypeRunner
{
    /**
     * @return array|null
     * @throws \Exception
     */
    public function getData(): ?array
    {
        $dataProvider = new DataProvider();
        $results = $dataProvider->getData($this->request);

        if (count($results) > 0) {
            $this->addBlackTypeRunners(
                $results,
                $dataProvider->getBlackTypeRunners($this->getUniqueRunnerIds($results))
            );
        }

        return $results;
    }

    protected function addBlackTypeRunners(array &$races, array $blackTypeRunners): void
    {
        $placedRunnersIds = [];
        array_walk(
            $blackTypeRunners,
            function ($horse) use (&$placedRunnersIds) {
                if (!in_array($horse->horse_uid, $placedRunnersIds)) {
                    $placedRunnersIds[] = $horse->horse_uid;
                }
            }
        );

        $blackTypeRunnersIds = [];
        array_walk(
            $races,
            function ($horse) use ($blackTypeRunners, $placedRunnersIds, &$blackTypeRunnersIds) {
                if (in_array($horse->horse_uid, $placedRunnersIds) &&
                    $this->isBlackType($blackTypeRunners[$horse->horse_uid])
                ) {
                    $blackTypeRunnersIds[] = $horse->horse_uid;
                }
            }
        );

        $this->updateRacesWithBlackTypeRunners($races, $blackTypeRunnersIds);
    }

    protected function getUniqueRunnerIds(array $races): array
    {
        $runnersIds = [];
        array_walk(
            $races,
            function ($horse) use (&$runnersIds) {
                $runnersIds[] = $horse->horse_uid;
            }
        );

        return $runnersIds;
    }

    /**
     * @param array $races
     * @param array $blackTypeRunnersIds
     */
    protected function updateRacesWithBlackTypeRunners(array $races, array $blackTypeRunnersIds): void
    {
        array_walk(
            $races,
            function ($horse) use ($blackTypeRunnersIds) {
                if (in_array($horse->horse_uid, $blackTypeRunnersIds)) {
                    $horse->black_type = 'Y';
                }
            }
        );
    }
}
