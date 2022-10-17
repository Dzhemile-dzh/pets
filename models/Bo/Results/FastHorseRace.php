<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 02.10.2014
 * Time: 13:52
 */

namespace Models\Bo\Results;

class FastHorseRace extends \Models\FastHorseRace
{
    /**
     * @param $fastRaceId
     *
     * @return array
     */
    public function getRaceFastResult($fastRaceId)
    {
        $sql = "
            SELECT
                fhr.horse_name,
                fhr.jockey_name,
                fhr.saddle_cloth_number,
                fhr.race_outcome_position,
                fhr.starting_price odds_desc,

                fri.fast_race_instance_uid,
                fri.course_name,
                fri.race_datetime,
                fri.favorite,
                fri.no_of_runners,
                fri.non_runners,
                fri.tote_win_money,
                fri.dual_forecast,
                fri.csf,
                fri.tricast,
                fri.placepot,
                fri.miscellaneous,

                ri.race_instance_uid,
                ri.formbook_yn,
                
                ff.fav_position,
                ff.pa_horse_name,
                ff.pa_odds,
                ff.fav_joint
            FROM fast_horse_race fhr
                JOIN fast_race_instance fri ON fri.fast_race_instance_uid = fhr.fast_race_instance_uid
                JOIN race_instance ri ON ri.race_datetime = fri.race_datetime
                JOIN course c ON ri.course_uid = c.course_uid
                    AND (UPPER(c.course_name + ' (' + c.country_code + ')') LIKE UPPER(fri.course_name) + '%')
                LEFT JOIN favourite_fast ff ON ff.real_race_instance_uid = ri.race_instance_uid
                    AND ff.fav_position = 2
            WHERE
                fhr.fast_race_instance_uid = :raceId:
            ORDER BY fhr.race_outcome_position

        ";

        $res = $this->getReadConnection()->query(
            $sql,
            array('raceId' => $fastRaceId)
        );

        $raceResult = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        $raceResult = $raceResult->getGroupedResult(
            [
                'course_name',
                'race_datetime',
                'favorite',
                'no_of_runners',
                'non_runners',
                'tote_win_money',
                'dual_forecast',
                'csf',
                'tricast',
                'placepot',
                'miscellaneous',
                'race_instance_uid',
                'fast_race_instance_uid',
                'formbook_yn',
                'fav_position',
                'pa_horse_name',
                'pa_odds',
                'fav_joint',

                'horses' => [
                    'horse_name',
                    'saddle_cloth_number',
                    'jockey_name',
                    'odds_desc',
                    'race_outcome_position',
                ]
            ]
        );

        return isset($raceResult[0]) ? $raceResult[0] : null;
    }

    /**
     * @param int|null $raceId
     *
     * @return int
     */
    public function getFastRaceId($raceId)
    {
        $sql = "
            SELECT
                fhr.fast_race_instance_uid
            FROM fast_horse_race fhr
                JOIN fast_race_instance fri ON fri.fast_race_instance_uid = fhr.fast_race_instance_uid
                JOIN race_instance ri ON ri.race_datetime = fri.race_datetime
                JOIN course c ON ri.course_uid = c.course_uid
                    AND (UPPER(c.course_name + ' (' + c.country_code + ')') LIKE UPPER(fri.course_name) + '%')
            WHERE
                ri.race_instance_uid = :raceId:
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            array('raceId' => $raceId)
        );

        $raceResult = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return isset($raceResult->getFirst()->fast_race_instance_uid)
            ? intval($raceResult->getFirst()->fast_race_instance_uid)
            : null;
    }
}
