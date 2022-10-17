<?php

namespace Bo\OwnerGroups;

use Api\Constants\Horses as Constants;
use Api\DataProvider\Bo\OwnerGroups\Entries as DataProvider;
use Models\Bo\HorseProfile\Horse as HorseModel;

/**
 * Class Entries
 *
 * @package Bo\OwnerGroups
 */
class Entries extends BlackTypeRunner
{
    /**
     * @return HorseModel
     */
    protected function getModelHorse()
    {
        return new HorseModel();
    }
    /**
     * @return array|null
     * @throws \Exception
     */
    public function getData(): ?array
    {
        $provider = new DataProvider();
        $races = $provider->getData($this->request);

        if (count($races) > 0) {
            $this->addBlackTypeRunners($races, $provider->getBlackTypeRunners($this->getUniqueRunnerIds($races)));
            if ($this->request->isParameterExists('ownerGroupId') &&
                ($this->request->getOwnerGroupId() == Constants::SKIP_OWNER_GROUP_ID_CHECK)) {
                $this->addSalesDataForHorses($races);
            }
        }

        return $races;
    }

    /**
     * @param array $races
     *
     * @return array
     */
    protected function getUniqueRunnerIds(array $races): array
    {
        $runnersIds = [];
        array_walk(
            $races,
            function ($race) use (&$runnersIds) {
                foreach ($race['runners'] as $runner) {
                    $runnersIds[$runner->horse_uid] = $runner->horse_uid;
                }
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
            function ($race) use ($blackTypeRunnersIds) {
                foreach ($race['runners'] as $runner) {
                    if (in_array($runner->horse_uid, $blackTypeRunnersIds)) {
                        $runner->black_type = 'Y';
                    }
                }
            }
        );
    }
}
