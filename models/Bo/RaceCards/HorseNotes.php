<?php

namespace Models\Bo\RaceCards;

use Api\Constants\Horses as Constants;

/**
 * Class HorseNotes
 *
 * @package Models\Bo\RaceCards
 */
class HorseNotes extends \Models\HorseNotes
{
    /**
     * @param string $dateBegin
     * @param string $dateEnd
     *
     * @return array
     */
    public function getStableToursDatabase($dateBegin, $dateEnd)
    {
        $sql = "
            SELECT
                ri.race_instance_uid,
                ri.race_datetime,
                ri.race_status_code,
                c.style_name AS course_style_name,
                c.course_name,
                c.course_uid,
                h.horse_uid,
                h.style_name AS horse_style_name,
                h.country_origin_code AS horse_country_origin_code,
                hn.notes,
                t.trainer_uid,
                t.style_name AS trainer_style_name
            FROM horse_notes hn
                JOIN horse h ON h.horse_uid = hn.horse_uid
                JOIN pre_horse_race phr ON phr.horse_uid = hn.horse_uid
                JOIN race_instance ri ON
                    ri.race_instance_uid = phr.race_instance_uid
                    AND ri.race_status_code = phr.race_status_code
                JOIN course c ON c.course_uid = ri.course_uid
                JOIN horse_trainer ht ON
                    ht.horse_uid = phr.horse_uid
                    AND ht.trainer_change_date = ISNULL(
                            (
                            SELECT MIN(t2.trainer_change_date)
                            FROM horse_trainer t2
                            WHERE
                                t2.horse_uid = phr.horse_uid
                                AND t2.trainer_change_date > ri.race_datetime
                            ),
                        '" . Constants::EMPTY_DATE . "'
                    )
                JOIN trainer t ON t.trainer_uid = ht.trainer_uid
            WHERE
                hn.notes_type_code IN (" . Constants::NOTES_TYPE_CODE_STABLE_TOUR_FLAT . ", "
            . Constants::NOTES_TYPE_CODE_STABLE_TOUR_JUMPS . ", " . Constants::NOTES_TYPE_CODE_WEEKENDER_STABLE_TOUR . ")
                AND ri.race_datetime BETWEEN :dateBegin AND :dateEnd
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND (c.country_code IN ('GB', 'IRE')
                    OR NOT EXISTS (
                        SELECT 1 FROM race_attrib_lookup ral, race_attrib_join raj
                        WHERE raj.race_instance_uid = ri.race_instance_uid
                            AND raj.race_attrib_uid = ral.race_attrib_uid
                            AND ral.race_attrib_uid IN (" . Constants::INCOMPLETE_CARD_ATTRIBUTE_ID . " , "
            . Constants::INCOMPLETE_RACE_ATTRIBUTE_ID . " )
                        )
                )
            ORDER BY ri.race_datetime
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'dateBegin' => $dateBegin,
                'dateEnd' => $dateEnd,
            ]
        );

        $collection = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return $collection->toArrayWithRows();
    }

    /**
     * @param string
     *
     * @return array
     */
    public function getStableToursDatabaseByHorseName($searchTerm)
    {
        $sql = "
            SELECT
                horse.horse_uid,
                horse.style_name  AS horse_style_name,
                horse.country_origin_code AS horse_country_origin_code,
                horse_notes.notes,
                trainer.trainer_uid,
                trainer.style_name AS trainer_style_name

            FROM horse_notes
            JOIN horse ON horse.horse_uid = horse_notes.horse_uid
            JOIN horse_trainer ON
                horse_trainer.horse_uid = horse.horse_uid
                AND horse_trainer.trainer_change_date = ISNULL(
                    (
                        SELECT MIN(t2.trainer_change_date)
                        FROM horse_trainer t2
                        WHERE
                            t2.horse_uid = horse.horse_uid
                            AND t2.trainer_change_date > GETDATE()
                    ),
                    '" . Constants::EMPTY_DATE . "'
                )
            JOIN trainer ON trainer.trainer_uid = horse_trainer.trainer_uid

            WHERE
                horse_notes.notes_type_code IN (" . Constants::NOTES_TYPE_CODE_STABLE_TOUR_FLAT . ", "
            . Constants::NOTES_TYPE_CODE_STABLE_TOUR_JUMPS . ", " . Constants::NOTES_TYPE_CODE_WEEKENDER_STABLE_TOUR . ")
                AND horse.horse_name LIKE :searchTerm
                AND horse.horse_name NOT LIKE '00%'

            ORDER BY horse.searchname
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'searchTerm' => $searchTerm . '%',
            ]
        );

        $collection = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return $this->joinRaceInfoToStableToursDatabase($collection);
    }

    /**
     * @param string $searchTerm
     *
     * @return array
     */
    public function getStableToursDatabaseByTrainerName($searchTerm)
    {
        $sql = "
            SELECT
                horse.horse_uid,
                horse.style_name  AS horse_style_name,
                horse.country_origin_code AS horse_country_origin_code,
                horse_notes.notes,
                trainer.trainer_uid,
                trainer.style_name AS trainer_style_name

            FROM horse_notes
            JOIN horse ON horse.horse_uid = horse_notes.horse_uid
            JOIN horse_trainer ON horse_trainer.horse_uid = horse.horse_uid
            JOIN trainer ON trainer.trainer_uid = horse_trainer.trainer_uid

            WHERE
                trainer.trainer_name LIKE :searchTerm

            ORDER BY horse.searchname
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'searchTerm' => '%' . $searchTerm . '%',
            ]
        );

        $collection = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return $this->joinRaceInfoToStableToursDatabase($collection);
    }

    /**
     * @param \Phalcon\Mvc\Model\Resultset\General $stableToursDatabase
     *
     * @return array
     * @throws \Exception
     */
    private function joinRaceInfoToStableToursDatabase(\Phalcon\Mvc\Model\Resultset\General $stableToursDatabase)
    {
        if (count($stableToursDatabase)) {
            $horseUids = $stableToursDatabase->getField('horse_uid');
            $trainerUids = $stableToursDatabase->getField('trainer_uid');

            $sql = "
                SELECT
                    hr.horse_uid,
                    ri.race_instance_uid,
                    ri.race_datetime,
                    ri.race_status_code,
                    c.style_name AS course_style_name,
                    c.course_name,
                    c.course_uid,
                    ht.trainer_uid
                FROM horse_race hr
                    JOIN race_instance ri ON hr.race_instance_uid = ri.race_instance_uid
                    JOIN course c ON c.course_uid = ri.course_uid
                    JOIN horse_trainer ht ON ht.horse_uid = hr.horse_uid
                WHERE
                    hr.horse_uid IN (:horseUids)
                    AND ht.trainer_uid IN (:trainerUids)
                    AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
            UNION
                SELECT
                    phr.horse_uid,
                    ri.race_instance_uid,
                    ri.race_datetime,
                    ri.race_status_code,
                    c.style_name AS course_style_name,
                    c.course_name,
                    c.course_uid,
                    ht.trainer_uid
                FROM pre_horse_race phr
                    JOIN race_instance ri ON phr.race_instance_uid = ri.race_instance_uid
                    JOIN course c ON c.course_uid = ri.course_uid
                    JOIN horse_trainer ht ON ht.horse_uid = phr.horse_uid
                WHERE
                    phr.horse_uid IN (:horseUids)
                    AND ht.trainer_uid IN (:trainerUids)
                    AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
            ORDER BY ri.race_datetime DESC
        ";

            $res = $this->getReadConnection()->query(
                $sql,
                [
                    'horseUids' => $horseUids,
                    'trainerUids' => $trainerUids
                ]
            );

            $collection = new \Phalcon\Mvc\Model\Resultset\General(
                null,
                new \Phalcon\Mvc\Model\Row\General(),
                $res
            );

            $raceInfo = $collection->toArrayWithRows('horse_uid', null, true);

            $stableToursDatabase = $stableToursDatabase->toArrayWithRows();

            foreach ($stableToursDatabase as $key => $item) {
                if (isset($raceInfo[$item->horse_uid])) {
                    foreach ($raceInfo[$item->horse_uid] as $raceInfoItem) {
                        if ($item->trainer_uid == $raceInfoItem->trainer_uid
                            && (!isset($item->race_instance_uid)
                                || isset($item->race_instance_uid)
                                && strpos(Constants::RACE_STATUS_RESULTS, $raceInfoItem->race_status_code) === false
                            )
                        ) {
                            $item->race_instance_uid = $raceInfoItem->race_instance_uid;
                            $item->race_datetime = $raceInfoItem->race_datetime;
                            $item->race_status_code = $raceInfoItem->race_status_code;
                            $item->course_style_name = $raceInfoItem->course_style_name;
                            $item->course_name = $raceInfoItem->course_name;
                            $item->course_uid = $raceInfoItem->course_uid;
                        } else {
                            $item->race_instance_uid = null;
                            $item->race_datetime = null;
                            $item->race_status_code = null;
                            $item->course_style_name = null;
                            $item->course_name = null;
                            $item->course_uid = null;
                        }
                    }
                } else {
                    unset($stableToursDatabase[$key]);
                }
            }
        }
        return $stableToursDatabase;
    }
}
