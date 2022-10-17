<?php

namespace Bo\OwnerGroups;

use Bo\Standart;
use Phalcon\Mvc\Model\Row as Row;

/**
 * @package Bo\OwnerGroups
 */
abstract class BlackTypeRunner extends Standart
{
    /**
     * @return array|null
     * @throws \Exception
     */
    abstract public function getData(): ?array;

    /**
     * @param array $races
     *
     * @return array
     */
    abstract protected function getUniqueRunnerIds(array $races): array;

    /**
     * @param array $races
     * @param array $blackTypeRunners
     */
    protected function addBlackTypeRunners(array &$races, array $blackTypeRunners): void
    {
        $placedRunnersIds = [];
        array_walk(
            $blackTypeRunners,
            function ($runner) use (&$placedRunnersIds) {
                if (!in_array($runner->horse_uid, $placedRunnersIds)) {
                    $placedRunnersIds[] = $runner->horse_uid;
                }
            }
        );

        $blackTypeRunnersIds = [];
        array_walk(
            $races,
            function ($race) use ($blackTypeRunners, $placedRunnersIds, &$blackTypeRunnersIds) {
                foreach ($race['runners'] as $runner) {
                    if (in_array($runner->horse_uid, $placedRunnersIds) && $this->isBlackType($blackTypeRunners[$runner->horse_uid])) {
                        $blackTypeRunnersIds[] = $runner->horse_uid;
                    }
                }
            }
        );

        $this->updateRacesWithBlackTypeRunners($races, $blackTypeRunnersIds);
    }

    /**
     * @param array $races
     * @param array $blackTypeRunnersIds
     */
    abstract protected function updateRacesWithBlackTypeRunners(array $races, array $blackTypeRunnersIds): void;

    /**
     * @param Row $btRunner
     *
     * @return bool
     */
    protected function isBlackType(Row $btRunner): bool
    {
        return (
            ($btRunner->no_of_runners <= 4 && $btRunner->position == 1) ||
            ($btRunner->no_of_runners >= 5 && $btRunner->no_of_runners <= 7  && in_array($btRunner->position, [1, 2])) ||
            ($btRunner->no_of_runners >= 8 && $btRunner->no_of_runners <= 15 && in_array($btRunner->position, [1, 2, 3])) ||
            ($btRunner->no_of_runners > 15 && $btRunner->race_group_uid == 5 && in_array($btRunner->position, [1, 2, 3, 4])) ||
            ($btRunner->no_of_runners > 15 && $btRunner->race_group_uid != 5 && in_array($btRunner->position, [1, 2, 3]))
        );
    }
    /**
     * @param array $races
     */
    protected function addSalesDataForHorses(array &$races)
    {
        $horseIds = [];
        foreach ($races as $race) {
            foreach ($race->runners as $horse) {
                $horseIds[] = $horse->horse_uid;
            }
        }
        $sales = $this->getModelHorse()->getSales($horseIds);

        foreach ($races as $race) {
            foreach ($race->runners as $horse) {
                $horse->sales_info = isset($sales[$horse->horse_uid]) ? $sales[$horse->horse_uid]['sales'] : null;
            }
        }
    }
}
