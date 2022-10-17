<?php
namespace Api\DataProvider\Bo\StakesData;

use Api\DataProvider\Bo\StakesData;

class Jockey extends StakesData
{
    const ENTITY_NAME = 'jockey';

    /**
     * @return string
     */
    protected function getEntityName()
    {
        return self::ENTITY_NAME;
    }

    /**
     * @param int    $jockeyUid
     * @param int    $courseUid
     * @param string $raceType
     *
     * @return array
     */
    public function getJockeyData($jockeyUid, $courseUid, $raceType)
    {
        $where = [];
        $params = [
            'jockeyUid' => $jockeyUid,
        ];

        if (isset($courseUid)) {
            $params['courseUid'] = $courseUid;
            $where[] = 'ri.course_uid = :courseUid:';
        }

        if (isset($raceType)) {
            $params['raceType'] = $raceType;
            $where[] = "{$this->getSqlForRaceType()} = :raceType:";
        }

        return $this->getData($params, $where, new \Api\Row\StakesData\Jockey());
    }

    /**
     * @param int    $jockeyUid
     * @param int    $courseUid
     * @param string $raceType
     *
     * @return array
     */
    public function getCurrentSeason($jockeyUid, $courseUid, $raceType)
    {
        $where = [];
        $params = [
            'jockeyUid' => $jockeyUid,
        ];

        if (isset($courseUid)) {
            $params['courseUid'] = $courseUid;
            $where[] = 'ri.course_uid = :courseUid:';
        }

        if (isset($raceType)) {
            $params['raceType'] = $raceType;
            $where[] = "{$this->getSqlForRaceType()} = :raceType:";
        }

        return parent::getCurrentSeasonData($params, $where, new \Api\Row\StakesData\Jockey());
    }
}
