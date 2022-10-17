<?php

namespace Bo\Bloodstock\Stallion;

use Bo\Bloodstock\Stallion;

/**
 * Class ProgenyHorses
 * @package Bo\Bloodstock\Stallion
 */
class ProgenyHorses extends Stallion
{
    const BO = 'progenyHorses';

    private $availableMore;

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
     * @param bool $orderByBestOr
     * @return mixed
     * @throws \Exception
     */
    public function getProgenyHorses(bool $orderByBestOr = false)
    {
        list($progenyHorses, $this->availableMore) =
            $this->getProgenyHorsesDataProvider()->getProgenyHorses($this->request, $orderByBestOr);
        return $progenyHorses;
    }

    /**
     * @return mixed
     */
    public function isMoreProgenyAvailable()
    {
        return $this->availableMore;
    }

    /**
     * @return array|null
     */
    public function getFirstAndLastSeasons()
    {
        static $result = null;
        if ($result === null) {
            $result = [];
            $rangeRaceDatetime = $this->getProgenySeasonDataProvider()->getFirstLastProgenyRaceDatetime(
                $this->request->getStallionId()
            );
            if ($rangeRaceDatetime) {
                $appropriateFirstSeasons = $this->getProgenySeasonDataProvider()->getAppropriateSeasons(
                    $rangeRaceDatetime['first_race']
                );
                $appropriateLastSeasons = $this->getProgenySeasonDataProvider()->getAppropriateSeasons(
                    $rangeRaceDatetime['last_race']
                );

                if ($appropriateFirstSeasons && $appropriateLastSeasons) {
                    $result = [$appropriateFirstSeasons, $appropriateLastSeasons];
                }
            }
        }
        return $result;
    }
}
