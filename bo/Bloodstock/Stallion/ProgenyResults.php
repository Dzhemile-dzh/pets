<?php

namespace Bo\Bloodstock\Stallion;

use Bo\Bloodstock\Stallion;

/**
 * Class ProgenyResults
 * @package Bo\Bloodstock\Stallion
 */
class ProgenyResults extends Stallion
{
    const BO = 'progenyResults';

    /**
     * @param \Api\Input\Request\Horses\Profile $request
     * @return static
     */
    public static function initByModel(\Api\Input\Request\Horses\Profile $request)
    {
        $bo = parent::initByModel($request);
        $request->set(self::BO, $bo);

        return $bo;
    }

    /**
     * @return \Api\Row\Bloodstock\Stallion\ProgenyResults[]|null
     */
    public function getProgenyResults()
    {
        return $this->getProgenyResultsDataProvider()->getProgenyResults();
    }

    /**
     * @return array|null|\Phalcon\Mvc\Model\Row[]
     */
    public function getLastSeasons()
    {
        static $result = null;
        if ($result === null) {
            $result = [];
            //1)Get Last race
            $lastRaceDatetime = $this->getProgenySeasonDataProvider()->getLastProgenyRaceDatetime(
                $this->request->getStallionId()
            );
            if ($lastRaceDatetime) {
                //2)Get 3 seasons (FLAT, IRE JUMPS, GB JUMPS) appropriate for last race
                $appropriateSeasons = $this->getProgenySeasonDataProvider()->getAppropriateSeasons($lastRaceDatetime);
                if ($appropriateSeasons) {
                    $result = $appropriateSeasons;
                }
            }
        }
        return $result;
    }
}
