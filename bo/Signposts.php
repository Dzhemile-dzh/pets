<?php

namespace Bo;

use Api\DataProvider\Bo\Signposts\UpcomingRaces;
use Api\DataProvider\Factory\TmpSignpostsTables;

class Signposts extends Standart
{
    /**
     * @codeCoverageIgnore
     *
     * @return \Api\DataProvider\Bo\Signposts\UpcomingRaces
     */
    protected function getDataProvider()
    {
        if ($this->dataProvider === null) {
            $this->dataProvider = new UpcomingRaces();
            $factory = new TmpSignpostsTables();

            $this->dataProvider->setFactoryTmpSignpostsTables($factory);
        }
        $this->dataProvider->setRequest($this->getRequest());
        return $this->dataProvider;
    }

    /**
     * @return array|null
     */
    public function getHotTrainers()
    {
        return $this->getDataProvider()->getTrainers();
    }

    /**
     * @return array|null
     */
    public function getCourseTrainers()
    {
        return $this->getDataProvider()->getCourseTrainers();
    }

    /**
     * @return array|null
     */
    public function getHotJockeys()
    {
        return $this->getDataProvider()->getJockeys();
    }

    /**
     * @return array|null
     */
    public function getCourseJockeys()
    {
        return $this->getDataProvider()->getCourseJockeys();
    }

    /**
     * @return array|null
     */
    public function getTrainersJockeys()
    {
        return $this->getDataProvider()->getTrainersJockeys();
    }

    /**
     * @return array|null
     */
    public function getHorsesForCourses()
    {
        return $this->getDataProvider()->getHorses();
    }

    /**
     *
     * @return array
     */
    public function getTopUpcomingHorses()
    {
        return $this->getDataProvider()->getTopRpr();
    }

    /**
     * @return array|null
     */
    public function getAheadOfHandicapper()
    {
        return $this->getDataProvider()->getAheadOfHandicapper();
    }

    /**
     * @param $data
     *
     * @return array|null
     */
    public function buildListForMobile($data)
    {
        $result = array_values($this->buildListForMobileRecursive($data));
        return empty($result) ? null : $result;
    }

    /**
     * @return array|null
     */
    public function getSevenDayWinners()
    {
        return $this->getDataProvider()->getSevenDaysWinners();
    }

    /**
     * @return array|null
     */
    public function getSweetspots()
    {
        return $this->getDataProvider()->getSweetspots($this->request->getDate());
    }

    /**
     * @return array|null
     */
    public function getTravellersCheck()
    {
        return $this->getDataProvider()->getTravellersCheck();
    }

    /**
     * @return \Api\Row\Signposts[]|null
     */
    public function getFirstTimeBlinkers()
    {
        return $this->getDataProvider()->getFirstTimeBlinkers();
    }

    /**
     * @param      $data
     * @param null $upHorseUid
     * @param int  $level
     *
     * @return array
     */
    private function buildListForMobileRecursive($data, $upHorseUid = null, $level = 0)
    {
        $result = [];

        $maxLevel = 10;
        if ($level > $maxLevel) {
            return $result;
        }

        if (is_array($data) || is_object($data)) {
            foreach ($data as $key => $value) {
                $horseUid = null;
                if (is_object($value)) {
                    $horseUid = isset($value->horse_uid)
                        ? $value->horse_uid
                        : null;
                    if (!isset($horseUid)) {
                        $horseUid = $upHorseUid;
                    }

                    $raceUid = isset($value->race_instance_uid)
                        ? $value->race_instance_uid
                        : null;
                    if (isset($raceUid)) {
                        $key = $raceUid . '_' . $horseUid;

                        $result[$key] = (Object) [
                            'race_instance_uid' => $raceUid,
                            'horse_uid' => $horseUid
                        ];
                    }
                }

                $newUpHorseUid = !isset($upHorseUid)
                    ? $horseUid
                    : $upHorseUid;
                $result = $result + $this->buildListForMobileRecursive($value, $newUpHorseUid, $level + 1);
            }
        }

        return $result;
    }

    private $dataProvider;
}
