<?php

namespace Api\Bo\Traits;

use Bo\VideoProviders;

/**
 * Class AddVideoDetails
 *
 * @package Api\Bo\Traits
 */
trait AddVideoDetails
{
    /**
     * @param array $races
     */
    public function addVideoDetails(&$races)
    {
        if (empty($races)) {
            return;
        }

        $races = $this->combineRacesWithVideoDetails(
            $races,
            $this->fetchVideoProvidersByRaceIds(array_keys($races))
        );
    }

    /**
     * @param int[] $raceIds
     *
     * @return array
     */
    public function fetchVideoProvidersByRaceIds(array $raceIds)
    {
        return $this->getVideoProviders(array_unique($raceIds))->getDetails();
    }

    /**
     * @param array $races
     * @param array $videoDetails
     *
     * @return array
     */
    public function combineRacesWithVideoDetails(array $races, array $videoDetails)
    {
        foreach ($races as &$race) {
            $race->video_detail = isset($videoDetails[$race->race_instance_uid])
                ? $videoDetails[$race->race_instance_uid] : null;
        }

        return $races;
    }

    /**
     * @param $raceIDs
     * @return VideoProviders
     */
    protected function getVideoProviders($raceIDs)
    {
        return new VideoProviders($raceIDs);
    }

    /**
     * This is used to return a replay object used in the janus api's with all properties set to null
     */
    public function returnDefaultReplayObj()
    {
        $replayDetails = new \StdClass();
        $replayDetails->ptv_video_id        = null;
        $replayDetails->video_provider      = null;
        $replayDetails->complete_race_uid   = null;
        $replayDetails->complete_race_start = null;
        $replayDetails->complete_race_end   = null;
        $replayDetails->finish_race_uid     = null;
        $replayDetails->finish_race_start   = null;
        $replayDetails->finish_race_end     = null;
        return $replayDetails;
    }
}
