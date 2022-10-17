<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 1/11/2017
 * Time: 11:27 AM
 */

namespace Api\Input\Request\Parameter\Calculate\RaceType\Bloodstock\Stallion;

use Phalcon\Input\Request\Parameter\Calculate\ByDefault;
use Bo\Bloodstock\Stallion\ProgenyHorses as BoProgeny;

class ProgenyHorses extends ByDefault
{
    const DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * @return string|null
     */
    public function getValue()
    {
        if ($this->getModel() && $this->getBo()) {
            $firstAndLastSeasons = $this->getBo()->getFirstAndLastSeasons();
            if (!empty($firstAndLastSeasons)) {
                list($appropriateFirstSeasons, $appropriateLastSeasons) = $firstAndLastSeasons;
                list($startDateObj, $endDateObj) = $this->getModel()->getStartEndSeasonDate(
                    array_merge($appropriateFirstSeasons, $appropriateLastSeasons)
                );
                $raceType = $this->getModel()->getDefaultProgenyRaceType(
                    $this->getRequest()->getId(),
                    $startDateObj->format(self::DATE_FORMAT),
                    $endDateObj->format(self::DATE_FORMAT)
                );
            } else {
                $defaultSeason = $this->getModel()->getCurrentSeason();
                $raceType = $defaultSeason->raceType;
            }
            return $raceType;
        }
    }

    /**
     * @return \Api\DataProvider\Bo\Bloodstock\Stallion\ProgenySeason
     */
    private function getModel()
    {
        return $this->getRequest()->get(BoProgeny::MODEL_DEFAULT_INFO);
    }

    /**
     * @return \Bo\Bloodstock\Stallion\ProgenyHorses
     */
    private function getBo()
    {
        return $this->getRequest()->get(BoProgeny::BO);
    }
}
