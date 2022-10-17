<?php
namespace Api\DataProvider\Bo\StakesData;

use Api\DataProvider\Bo\StakesData;

class Trainer extends StakesData
{
    const ENTITY_NAME = 'trainer';

    /**
     * @return string
     */
    protected function getEntityName()
    {
        return self::ENTITY_NAME;
    }

    /**
     * @param int    $trainerUid
     * @param int    $courseUid
     * @param string $raceType
     *
     * @return array
     */
    public function getTrainerData($trainerUid, $courseUid, $raceType)
    {
        $where = [];
        $params = [
            'trainerUid' => $trainerUid,
        ];

        if (isset($courseUid)) {
            $params['courseUid'] = $courseUid;
            $where[] = 'ri.course_uid = :courseUid:';
        }

        if (isset($raceType)) {
            $params['raceType'] = $raceType;
            $where[] = "{$this->getSqlForRaceType()} = :raceType:";
        }

        return $this->getData($params, $where, new \Api\Row\StakesData\Trainer());
    }

    /**
     * @param int    $trainerUid
     * @param int    $courseUid
     * @param string $raceType
     *
     * @return array
     */
    public function getCurrentSeason($trainerUid, $courseUid, $raceType)
    {
        $where = [];
        $params = [
            'trainerUid' => $trainerUid,
        ];

        if (isset($courseUid)) {
            $params['courseUid'] = $courseUid;
            $where[] = 'ri.course_uid = :courseUid:';
        }

        if (isset($raceType)) {
            $params['raceType'] = $raceType;
            $where[] = "{$this->getSqlForRaceType()} = :raceType:";
        }

        return parent::getCurrentSeasonData($params, $where, new \Api\Row\StakesData\Trainer());
    }
}
