<?php

namespace Api\Bo\Traits;

trait FirstSeasonSire
{
    /**
     * This trait has the intent to add first_season_sire_id to a horse.
     * The result will be displayed as an array with integers.
     * @param $runners
     */
    public function addFirstSeasonSire(&$runners)
    {
        if (empty($runners)) {
            return;
        }

        $runnersIds = array_map(function ($runner) {
            return $runner['horse_uid'];
        }, $runners);
        $horsesArrayWithFirstSeasonSire = $this->getModelRunners()->getFirstSeasonSire($runnersIds);

        foreach ($runners as $runner) {
            if (isset($horsesArrayWithFirstSeasonSire[$runner['horse_uid']])) {
                $firstSeasonSireIds = $horsesArrayWithFirstSeasonSire[$runner['horse_uid']]["first_season_sire_ids"];
                $runner->first_season_sire_id = array_keys($firstSeasonSireIds);
            }
        }
    }
}
