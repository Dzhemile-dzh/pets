<?php

namespace Bo\OwnerGroups;

use Api\DataProvider\Bo\OwnerGroups\Results as DataProvider;
use Api\Input\Request\Horses\OwnerGroups\Results as Request;
use Bo\RaceCards\GodolphinReplay;
use GuzzleHttp\Client;
use \Api\Constants\Horses as Constants;
use Models\Bo\HorseProfile\Horse as HorseModel;

/**
 * @property Request $request
 *
 * @package Bo\OwnerGroups
 */
class Results extends BlackTypeRunner
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
     * @throws \GuzzleHttp\Exception\GuzzleException
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

            if ($this->getRequest()->isParameterExists('ownerGroupId') &&
                ($this->getRequest()->getOwnerGroupId() == Constants::SKIP_OWNER_GROUP_ID_CHECK)) {
                $this->addSalesDataForHorses($results);
            }
        }
        // we need to check if the ownerGroupId is provided in the URL, if so, we add godolphin race replay field to
        // the response.
        if ($this->getRequest()->isParameterProvided('ownerGroupId') && $this->request->getOwnerGroupId() == CONSTANTS::GODOLPHIN_OWNER_GROUP_ID) {
            $this->addGodolphinRaceReplayField($results);
        }

        return $results;
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
                    if (!in_array($runner->horse_uid, $runnersIds)) {
                        $runnersIds[] = $runner->horse_uid;
                    }
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

    /**
     * This method will add has_race_replay_video field to all races
     *
     * @param array $races an array of all given races
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function addGodolphinRaceReplayField($races)
    {
        $guzzleClient = new Client();
        $godolphinReplayClass = new GodolphinReplay($guzzleClient);

        foreach ($races as $race) {
            $race->has_race_replay_video = $godolphinReplayClass->checkRaceReplay($race['race_instance_uid']) ?? null;
        }
    }
}
