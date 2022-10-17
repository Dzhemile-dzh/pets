<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 7/6/2016
 * Time: 5:53 PM
 */

namespace Bo;

class HorseTracker extends Standart
{
    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\HorseTracker\RaceInstance
     */
    protected function getModelRaceInstance()
    {
        return new \Models\Bo\HorseTracker\RaceInstance();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\HorseTracker\Horse
     */
    protected function getModelHorse()
    {
        return new \Models\Bo\HorseTracker\Horse();
    }

    public function getEntries()
    {
        $entries = $this->getModelRaceInstance()->getEntries($this->request);
        return empty($entries) ? null : $entries;
    }

    public function getHorsesByUser()
    {
        return $this->getModelHorse()->getHorsesByUser($this->request, $this->getModelSelectors());
    }
}
