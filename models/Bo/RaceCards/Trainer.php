<?php

namespace Models\Bo\RaceCards;

use Api\Constants\Horses as Constants;

/**
 * Class Trainer
 *
 * @package Models\Bo\RaceCards
 */
class Trainer extends \Models\Trainer
{
    /**
     * @param $raceId
     *
     * @return array
     * @throws \Exception
     */
    public function getTrainerIdsForStatistics($raceId)
    {
        $sql = "
            SELECT horse_trainer.trainer_uid
            FROM race_instance
            JOIN pre_horse_race ON
                pre_horse_race.race_instance_uid = race_instance.race_instance_uid
                AND pre_horse_race.race_status_code =
                (
                    CASE
                        WHEN race_instance.race_status_code IN (" . Constants::RACE_STATUS_RESULTS . ","
            . Constants::RACE_STATUS_ABANDONED . ")
                        THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                        ELSE race_instance.race_status_code
                    END
                )
            JOIN horse_trainer ON
                horse_trainer.horse_uid = pre_horse_race.horse_uid
                AND horse_trainer.trainer_change_date = ISNULL(
                    (
                        SELECT MIN(t2.trainer_change_date)
                        FROM horse_trainer t2
                        WHERE
                            t2.horse_uid = pre_horse_race.horse_uid
                            AND t2.trainer_change_date > race_instance.race_datetime
                    ),
                    '" . Constants::EMPTY_DATE . "'
                )

            WHERE
                race_instance.race_instance_uid = :raceId:
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            ['raceId' => $raceId]
        );

        $trainers = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return $trainers->getField('trainer_uid');
    }

    public function getFilterTrainerspot($request)
    {
        $sql = [];
        $parameters = [];

        if ($request->isParameterSet('countryCode')) {
            $sql[] = 't.country_code = :countryCode:';
            $parameters['countryCode'] = $request->getCountryCode();
        }

        if ($request->getRequestType() == 'in-form') {
            $sql[] = 'EXISTS (
                SELECT 1
                FROM #trainers tt
                WHERE race_outcome_position = 1 AND tt.trainer_uid = t.trainer_uid)';
        }

        return [
            'sql' => $sql ? 'WHERE ' . implode(' AND ', $sql) : '',
            'parameters' => $parameters
        ];
    }

    public function getTrainerspot($request)
    {
        $filter = $this->getFilterTrainerspot($request);

        $sql = "
            SELECT DISTINCT
                t.trainer_uid,
                t.style_name,
                t.country_code
            INTO #todays_trainers
            FROM race_instance ri,
                pre_horse_race phr,
                course c,
                horse_trainer ht,
                trainer t
            WHERE ri.race_datetime BETWEEN :dateStart: AND :dateEnd:
                AND ri.race_instance_uid = phr.race_instance_uid
                AND ri.course_uid = c.course_uid
                AND c.country_code = 'GB'
                AND phr.horse_uid = ht.horse_uid
                AND phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                AND ht.trainer_change_date = '" . Constants::EMPTY_DATE . "'
                AND t.trainer_uid = ht.trainer_uid
        ";

        $this->getReadConnection()->execute(
            $sql,
            [
                'dateStart' => (new \DateTime())->format('Y-m-d') . ' 00:00',
                'dateEnd' => (new \DateTime())->format('Y-m-d') . ' 23:59'
            ],
            null,
            false
        );

        $sql = "
            SELECT
                tt.trainer_uid,
                tt.style_name,
                tt.country_code,
                ri.race_datetime,
                days_ago = DATEDIFF(DAY, ri.race_datetime, GETDATE()),
                ro.race_outcome_position,
                ro.race_outcome_form_char,
                rp_postmark = isnull(hr.rp_postmark,0),
                rp_pre_postmark = isnull(hr.rp_pre_postmark,0),
                race_group_uid = isnull(ri.race_group_uid,0),
                race_distance = ri.distance_yard,
                dist_to_winner = isnull(d.distance_value,0),
                runners = (SELECT COUNT(*)
                        FROM horse_race ihr, race_outcome iro
                        WHERE ihr.race_instance_uid = ri.race_instance_uid
                        AND ihr.final_race_outcome_uid = iro.race_outcome_uid
                        AND iro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . "))
            INTO #trainers
            FROM race_instance ri
            JOIN horse_race hr ON ri.race_instance_uid = hr.race_instance_uid
            JOIN #todays_trainers tt ON tt.trainer_uid = hr.trainer_uid
            JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
                AND ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
            JOIN course c ON ri.course_uid = c.course_uid
            LEFT JOIN dist_to_winner d ON hr.distance_to_winner_uid = d.dist_to_winner_uid
            WHERE ri.race_datetime > DATEADD(DAY, - 14, GETDATE())
            ORDER BY tt.trainer_uid, days_ago
        ";

        $this->getReadConnection()->execute(
            $sql,
            null,
            null,
            false
        );
        $sql = "SELECT * FROM #trainers t {$filter['sql']}";

        $result = $this->getReadConnection()->query(
            $sql,
            $filter['parameters']
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\RaceInstance(),
            $result
        );

        $trainers = $result->toArrayWithRows('trainer_uid', null, true);

        $this->getReadConnection()->execute("IF OBJECT_ID('#todays_trainers') IS NOT NULL DROP TABLE #todays_trainers");
        $this->getReadConnection()->execute("IF OBJECT_ID('#trainers') IS NOT NULL DROP TABLE #trainers");

        return $trainers;
    }
}
