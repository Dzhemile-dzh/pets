<?php
namespace Api\DataProvider\Bo\StakesData;

use Api\DataProvider\Bo\StakesData;

class Horse extends StakesData
{
    const ENTITY_NAME = 'horse';

    /**
     * @return string
     */
    protected function getEntityName()
    {
        return self::ENTITY_NAME;
    }

    /**
     * @param int    $horseUid
     * @param int    $courseUid
     * @param string $raceType
     *
     * @return array
     */
    public function getHorseData($horseUid, $courseUid, $raceType)
    {
        $where = [];
        $params = [
            'horseUid' => $horseUid,
        ];

        if (isset($courseUid)) {
            $params['courseUid'] = $courseUid;
            $where[] = 'ri.course_uid = :courseUid:';
        }

        if (isset($raceType)) {
            $params['raceType'] = $raceType;
            $where[] = "{$this->getSqlForRaceType()} = :raceType:";
        }

        return $this->getData($params, $where, new \Api\Row\StakesData\Horse());
    }

    /**
     * @param int    $horseUid
     * @param int    $courseUid
     * @param string $raceType
     *
     * @return array
     */
    public function getCurrentSeason($horseUid, $courseUid, $raceType)
    {
        $where = [];
        $params = [
            'horseUid' => $horseUid,
        ];

        if (isset($courseUid)) {
            $params['courseUid'] = $courseUid;
            $where[] = 'ri.course_uid = :courseUid:';
        }

        if (isset($raceType)) {
            $params['raceType'] = $raceType;
            $where[] = "{$this->getSqlForRaceType()} = :raceType:";
        }

        return parent::getCurrentSeasonData($params, $where, new \Api\Row\StakesData\Horse());
    }
}
