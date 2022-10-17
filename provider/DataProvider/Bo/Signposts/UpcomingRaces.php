<?php

namespace Api\DataProvider\Bo\Signposts;

use Api\DataProvider\Bo\Signposts\TmpTable\WorkSignpostDataToday as WsdTable;
use Api\DataProvider\HorsesDataProvider;
use Api\Row\Signposts as Row;
use Api\Constants\Horses as Constants;

/**
 * Class UpcomingRaces
 *
 * @package Api\DataProvider\Bo\Signposts
 */
class UpcomingRaces extends HorsesDataProvider
{

    const RESTRICTION_RACE_STATUS_CODE = 1;
    const RESTRICTION_OWNER_CHANGE_DATE = 2;
    const RESTRICTION_OWNER_CHANGE_DATE_MIN = 4;
    const RESTRICTION_TRAINER_CHANGE_DATE = 8;
    const RESTRICTION_COUNTRY_CODES = 16;
    const RESTRICTION_TODAY_DATE = 32;

    const FIRST_TIME_HOOD_CHAR = 'h';
    const FIRST_TONGUE_TIE = 't';
    private $placeholders = [];

    /**
     * @return \Api\DataProvider\Factory\TmpSignpostsTables
     */
    public function getFactoryTmpSignpostsTables()
    {
        return $this->factoryTmpSignpostsTables;
    }

    /**
     * @param \Api\DataProvider\Factory\TmpSignpostsTables $factoryTmpSignpostsTables
     */
    public function setFactoryTmpSignpostsTables($factoryTmpSignpostsTables)
    {
        $this->factoryTmpSignpostsTables = $factoryTmpSignpostsTables;
    }

    /**
     * @param $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return \Api\Input\Request\HorsesRequest
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param $date
     *
     * @return null
     */
    public function getSweetspots($date)
    {
        $date = empty($date) ? (new \DateTime($date))->format('Y-m-d') : $date;
        $sql = "
            SELECT
                ri.race_instance_uid
                , ri.race_datetime
                , c.course_uid
                , course_style_name = c.style_name
                , prtv.verdict
                , phr.horse_uid
                , horse_name = h.style_name
                , start_number = phr.saddle_cloth_no
                , non_runner = CASE WHEN phr.non_runner = 'Y' THEN 'Y' ELSE 'N' END
                , phr.jockey_uid
                , jockey_name = j.style_name
                , ho.owner_uid
                , owner_name = o.style_name
                , trainer_name = t.style_name
                , ht.trainer_uid
            FROM
                pre_race_tipster_verdicts prtv
                JOIN race_instance ri ON ri.race_instance_uid = prtv.race_instance_uid
                JOIN course c ON c.course_uid = ri.course_uid
                JOIN verdict_selection vs ON vs.newspaper_uid = " . WsdTable::SWEETSPOTS_STATS . "
                    AND vs.race_instance_uid = ri.race_instance_uid
                LEFT JOIN pre_horse_race phr ON phr.race_instance_uid = ri.race_instance_uid
                    AND phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                    AND vs.horse_uid = phr.horse_uid
                LEFT JOIN horse h ON h.horse_uid = phr.horse_uid
                LEFT JOIN horse_trainer ht ON ht.horse_uid = phr.horse_uid
                    AND ht.trainer_change_date = '" . Constants::EMPTY_DATE . "'
                LEFT JOIN horse_owner ho ON ho.horse_uid = phr.horse_uid
                    AND ho.owner_change_date = '" . Constants::EMPTY_DATE . "'
                LEFT JOIN trainer t ON t.trainer_uid = ht.trainer_uid
                LEFT JOIN jockey j ON j.jockey_uid = phr.jockey_uid
                LEFT JOIN owner o ON o.owner_uid = ho.owner_uid
            WHERE ri.race_datetime BETWEEN :date_from AND :date_to
                AND prtv.newspaper_uid = " . WsdTable::SWEETSPOTS_STATS . "
        ";

        $this->parameters['date_from'] = $date . ' 00:00:00.0';
        $this->parameters['date_to'] = $date . ' 23:59:59.0';

        return $this->getResult(
            $sql
        );
    }

    /**
     * @return \Api\Row\Signposts|null
     */

    public function getTrainers()
    {
        $sql = "
            SELECT
                ht.trainer_uid
                , trainer_name = t.style_name
                , prie.race_datetime
                , prie.horse_uid
                , prie.saddle_cloth_no
                , horse_name = prie.horse_style_name
                , prie.horse_country_origin_code
                , prie.course_uid
                , country_code = prie.course_country_code
                , course_name = prie.course_style_name
                , prie.owner_uid
                , prie.rp_owner_choice
                , prie.non_runner
                , prie.race_instance_uid
                , prie.race_instance_title
                , declared_runners = prie.pri_no_of_runners
                , prie.race_group_desc
                , prie.perform_race_uid_atr
                , prie.perform_race_uid_ruk
                , wsd.wins_14
                , wsd.runs_14
                , percentage = wsd.percent
            FROM
                {$this->getFactoryTmpSignpostsTables()->getPreRaceInstanceExtended($this->getRequest())} prie
                JOIN horse_trainer ht
                    ON prie.horse_uid = ht.horse_uid
                JOIN trainer t
                    ON t.trainer_uid = ht.trainer_uid
                JOIN {$this->getFactoryTmpSignpostsTables()->getWorkSignpostsDataToday()} wsd
                    ON wsd.type = " . WsdTable::HOT_TRAINERS_STATS . " AND wsd.trainer_uid = t.trainer_uid
            WHERE
                {$this->getRestrictions(self::RESTRICTION_RACE_STATUS_CODE
                 | self::RESTRICTION_OWNER_CHANGE_DATE_MIN
                 | self::RESTRICTION_TRAINER_CHANGE_DATE
                 | self::RESTRICTION_TODAY_DATE)}
            ORDER BY
                t.trainer_uid, prie.horse_uid, prie.race_datetime
            ";

        return $this->getResult(
            $sql,
            [
                'trainer_uid',
                'trainer_name',
                'wins_14',
                'runs_14',
                'percentage',
                'entries(\Api\Row\Signposts)' => $this->getEntries(),
            ],
            [
                'trainer_uid'
            ]
        );
    }

    /**
     * @return \Api\Row\Signposts|null
     */
    public function getJockeys()
    {
        $sql = "
            SELECT
                j.jockey_uid
                , jockey_name = j.style_name
                , prie.race_datetime
                , prie.horse_uid
                , prie.saddle_cloth_no
                , horse_name = prie.horse_style_name
                , horse_country_origin_code = prie.horse_country_origin_code
                , prie.course_uid
                , country_code = prie.course_country_code
                , course_name = prie.course_style_name
                , prie.owner_uid
                , prie.rp_owner_choice
                , prie.non_runner
                , prie.race_instance_uid
                , prie.race_instance_title
                , declared_runners = prie.pri_no_of_runners
                , prie.race_group_desc
                , prie.perform_race_uid_atr
                , prie.perform_race_uid_ruk
                , wsd.wins_14
                , wsd.runs_14
                , percentage = wsd.percent
            FROM
                {$this->getFactoryTmpSignpostsTables()->getPreRaceInstanceExtended($this->getRequest())} prie
                JOIN jockey j
                    ON prie.jockey_uid = j.jockey_uid
                JOIN {$this->getFactoryTmpSignpostsTables()->getWorkSignpostsDataToday()} wsd
                    ON wsd.type = " . WsdTable::HOT_JOCKEYS_STATS . " AND wsd.jockey_uid = prie.jockey_uid
            WHERE
                {$this->getRestrictions(self::RESTRICTION_RACE_STATUS_CODE
                 | self::RESTRICTION_OWNER_CHANGE_DATE_MIN
                 | self::RESTRICTION_TODAY_DATE)}
            ORDER BY
                j.jockey_uid, prie.horse_uid, prie.race_datetime
            ";

        return $this->getResult(
            $sql,
            [
                'jockey_uid',
                'jockey_name',
                'wins_14',
                'runs_14',
                'percentage',
                'entries(\Api\Row\Signposts)' => $this->getEntries(),
            ],
            [
                'jockey_uid'
            ]
        );
    }

    /**
     * @return \Api\Row\Signposts|null
     */
    public function getHorses()
    {
        $sql = "
            SELECT
                prie.race_datetime
                , prie.horse_uid
                , prie.saddle_cloth_no
                , horse_name = prie.horse_style_name
                , horse_country_origin_code = prie.horse_country_origin_code
                , prie.course_uid
                , country_code = prie.course_country_code
                , course_name = prie.course_style_name
                , prie.owner_uid
                , prie.rp_owner_choice
                , prie.non_runner
                , prie.race_instance_uid
                , prie.race_instance_title
                , declared_runners = prie.pri_no_of_runners
                , prie.race_group_desc
                , prie.perform_race_uid_atr
                , prie.perform_race_uid_ruk
                , wsd.course_and_distance
                , wsd.course_winner
                , wsd.course_runner
                , cd_perc = CASE WHEN wsd.course_runner != 0
                                THEN round(CONVERT(FLOAT,wsd.course_and_distance) / wsd.course_runner * 100,0)
                                ELSE 0 END
                , c_perc = CASE WHEN wsd.course_runner != 0
                                THEN round((CONVERT(FLOAT,wsd.course_winner) / wsd.course_runner) * 100,0)
                                ELSE 0 END
            FROM
                {$this->getFactoryTmpSignpostsTables()->getPreRaceInstanceExtended($this->getRequest())} prie
                JOIN {$this->getFactoryTmpSignpostsTables()->getWorkSignpostsDataToday()} wsd
                    ON wsd.type = " . WsdTable::HORSES_FOR_COURSES_STATS . " AND wsd.horse_uid = prie.horse_uid
            WHERE
                {$this->getRestrictions(self::RESTRICTION_RACE_STATUS_CODE
                    | self::RESTRICTION_OWNER_CHANGE_DATE_MIN
                     | self::RESTRICTION_TODAY_DATE)}
            ORDER BY
                prie.horse_uid, prie.race_datetime
            ";

        return $this->getResult(
            $sql,
            [
                'horse_name',
                'country_code',
                'horse_uid',
                'saddle_cloth_no',
                'course_and_distance',
                'course_winner',
                'course_runner',
                'cd_perc',
                'c_perc',
                'entries(\Api\Row\Signposts)' => $this->getEntries(),
            ],
            [
                'horse_uid'
            ]
        );
    }

    /**
     * @return \Api\Row\Signposts|null
     */
    public function getTrainersJockeys()
    {
        $sql = "
            SELECT
                trainer_jockey = CONVERT(VARCHAR, ht.trainer_uid) + '_' + CONVERT(VARCHAR, prie.jockey_uid)
                , prie.jockey_uid
                , wsd.jockey_name
                , ht.trainer_uid
                , wsd.trainer_name
                , prie.race_datetime
                , prie.horse_uid
                , prie.saddle_cloth_no
                , horse_name = prie.horse_style_name
                , horse_country_origin_code = prie.horse_country_origin_code
                , prie.course_uid
                , country_code = prie.course_country_code
                , course_name = prie.course_style_name
                , prie.owner_uid
                , prie.rp_owner_choice
                , prie.non_runner
                , prie.race_instance_uid
                , prie.race_instance_title
                , declared_runners = prie.pri_no_of_runners
                , prie.race_group_desc
                , prie.perform_race_uid_atr
                , prie.perform_race_uid_ruk
                , t_percent = wsd.d7_perc
                , j_percent = wsd.d8_perc
                , wsd.percent
            FROM
                {$this->getFactoryTmpSignpostsTables()->getPreRaceInstanceExtended($this->getRequest())} prie
                JOIN horse_trainer ht
                    ON prie.horse_uid = ht.horse_uid
                JOIN {$this->getFactoryTmpSignpostsTables()->getWorkSignpostsDataToday()} wsd
                    ON wsd.type = " . WsdTable::TRAINERS_JOCKEYS_STATS . "
                    AND wsd.jockey_uid = prie.jockey_uid
                    AND wsd.trainer_uid = ht.trainer_uid
            WHERE
                {$this->getRestrictions(self::RESTRICTION_RACE_STATUS_CODE
                 | self::RESTRICTION_OWNER_CHANGE_DATE_MIN
                 | self::RESTRICTION_TRAINER_CHANGE_DATE
                 | self::RESTRICTION_TODAY_DATE)}
            ORDER BY
                1, ht.trainer_uid, prie.jockey_uid, prie.horse_uid, prie.race_datetime
            ";

        return $this->getResult(
            $sql,
            [
                'trainer_jockey',
                'trainer_uid',
                'trainer_name',
                'jockey_uid',
                'jockey_name',
                't_percent',
                'j_percent',
                'percent',
                'entries(\Api\Row\Signposts)' => $this->getEntries(),
            ],
            [
                'trainer_jockey'
            ]
        );
    }

    /**
     * @return \Api\Row\Signposts|null
     */
    public function getCourseJockeys()
    {
        $sql = "
            SELECT
                j.jockey_uid
                , jockey_name = j.style_name
                , wsd.d7_wins
                , wsd.d7_runs
                , wsd.d7_perc
                , prie.race_datetime
                , prie.horse_uid
                , prie.saddle_cloth_no
                , horse_name = prie.horse_style_name
                , horse_country_origin_code = prie.horse_country_origin_code
                , prie.course_uid
                , country_code = prie.course_country_code
                , course_name = prie.course_style_name
                , prie.owner_uid
                , prie.rp_owner_choice
                , prie.non_runner
                , prie.race_instance_uid
                , prie.race_instance_title
                , declared_runners = prie.pri_no_of_runners
                , prie.race_group_desc
                , prie.perform_race_uid_atr
                , prie.perform_race_uid_ruk
            FROM
                {$this->getFactoryTmpSignpostsTables()->getPreRaceInstanceExtended($this->getRequest())} prie
                JOIN jockey j
                    ON j.jockey_uid = prie.jockey_uid
                JOIN {$this->getFactoryTmpSignpostsTables()->getWorkSignpostsDataToday()} wsd
                    ON wsd.type = " . WsdTable::COURSE_JOCKEYS_STATS . "
                    AND wsd.jockey_uid = j.jockey_uid
                    AND prie.course_uid = wsd.course_uid
            WHERE
                {$this->getRestrictions(self::RESTRICTION_OWNER_CHANGE_DATE | self::RESTRICTION_TODAY_DATE)}
            ORDER BY
                prie.course_uid, j.jockey_uid, prie.horse_uid, prie.race_datetime
            ";

        return $this->getResult(
            $sql,
            [
                'course_uid',
                'course_name',
                'country_code',
                'jockeys(\Api\Row\Signposts)' => [
                    'jockey_uid',
                    'jockey_name',
                    'd7_wins',
                    'd7_runs',
                    'd7_perc',
                    'entries(\Api\Row\Horse)' => $this->getEntries()
                ]
            ],
            [
                'course_uid',
                'jockey_uid',
            ]
        );
    }

    /**
     * @return \Api\Row\Signposts|null
     */
    public function getCourseTrainers()
    {
        $sql = "
            SELECT
                ht.trainer_uid
                , trainer_name = t.style_name
                , wsd.d7_wins
                , wsd.d7_runs
                , wsd.d7_perc
                , prie.race_datetime
                , prie.horse_uid
                , prie.saddle_cloth_no
                , horse_name = prie.horse_style_name
                , horse_country_origin_code = prie.horse_country_origin_code
                , prie.course_uid
                , country_code = prie.course_country_code
                , course_name = prie.course_style_name
                , prie.owner_uid
                , prie.rp_owner_choice
                , prie.non_runner
                , prie.race_instance_uid
                , prie.race_instance_title
                , declared_runners = prie.pri_no_of_runners
                , prie.race_group_desc
                , prie.perform_race_uid_atr
                , prie.perform_race_uid_ruk
            FROM
                {$this->getFactoryTmpSignpostsTables()->getPreRaceInstanceExtended($this->getRequest())} prie
                JOIN horse_trainer ht
                    ON prie.horse_uid = ht.horse_uid
                JOIN trainer t
                    ON t.trainer_uid = ht.trainer_uid
                JOIN {$this->getFactoryTmpSignpostsTables()->getWorkSignpostsDataToday()} wsd
                    ON wsd.type = " . WsdTable::COURSE_TRAINERS_STATS . "
                    AND wsd.trainer_uid = t.trainer_uid AND prie.course_uid = wsd.course_uid
            WHERE
                {$this->getRestrictions(self::RESTRICTION_OWNER_CHANGE_DATE
                 | self::RESTRICTION_TRAINER_CHANGE_DATE
                 | self::RESTRICTION_TODAY_DATE)}
            ORDER BY
                prie.course_uid, t.trainer_uid, prie.horse_uid, prie.race_datetime
            ";

        return $this->getResult(
            $sql,
            [
                'course_uid',
                'course_name',
                'country_code',
                'trainers(\Api\Row\Signposts)' => [
                    'trainer_uid',
                    'trainer_name',
                    'd7_wins',
                    'd7_runs',
                    'd7_perc',
                    'entries(\Api\Row\Horse)' => $this->getEntries()
                ]
            ],
            [
                'course_uid',
                'trainer_uid',
            ]
        );
    }

    /**
     * @return \Api\Row\Signposts|null
     */
    public function getSevenDaysWinners()
    {
        $sql = "
            SELECT
                h.country_code
                , h.horse_name
                , h.saddle_cloth_no
                , h.horse_country_origin_code
                , h.course_name
                , h.non_runner
                , h.race_datetime
                , h.race_instance_uid
                , h.race_instance_title
                , h.declared_runners
                , h.race_group_desc
                , h.perform_race_uid_atr
                , h.perform_race_uid_ruk
                , h.course_won
                , date_won = datename(weekday, h.date_won)
                , h.trainer_name
                , s.d7_wins
                , s.d7_runs
                , s.d7_perc
                , s.d8_perc
                , h.course_uid
                , h.trainer_uid
                , h.course_won_uid
                , h.horse_uid
                , h.owner_uid
                , h.rp_owner_choice
            FROM
                {$this->getFactoryTmpSignpostsTables()->getSevenDaysWinners(
                        $this->getRequest()
                    )->today->getTemporaryTable()} h
                , {$this->getFactoryTmpSignpostsTables()->getSevenDaysWinners(
                        $this->getRequest()
                   )->statistics->getTemporaryTable()} s
            WHERE
                h.trainer_uid = s.trainer_uid
        ";

        return $this->getResult($sql, null, 'horse_uid');
    }

    /**
     * @return \Api\Row\Signposts|null
     */
    public function getAheadOfHandicapper()
    {
        $sql = "
            SELECT
                prie.horse_style_name
                , prie.horse_country_origin_code
                , prie.horse_uid
                , prie.saddle_cloth_no
                , prie.race_datetime
                , prie.course_uid
                , prie.course_style_name
                , prie.course_name
                , wsd.country_code
                , wsd.losses_out
                , prie.owner_uid
                , prie.rp_owner_choice
                , prie.non_runner
                , prie.race_instance_uid
                , prie.race_instance_title
                , declared_runners = prie.pri_no_of_runners
                , prie.race_group_desc
                , prie.perform_race_uid_atr
                , prie.perform_race_uid_ruk
            FROM
                {$this->getFactoryTmpSignpostsTables()->getPreRaceInstanceExtended($this->getRequest())} prie
                JOIN " . WsdTable::TABLE_NAME . " wsd ON (
                    wsd.race_datetime = prie.race_datetime AND
                    1 = (CASE WHEN wsd.horse_uid IS NULL
                        AND prie.horse_style_name = wsd.horse_name
                        OR wsd.horse_uid = prie.horse_uid THEN 1 END) AND
                    1 = (CASE WHEN wsd.course_uid IS NULL
                        AND prie.rp_abbrev_4 = wsd.course_name
                        AND prie.course_country_code = wsd.country_code
                        OR wsd.course_uid = prie.course_uid THEN 1 END) AND
                    wsd.type = " . WsdTable::AHEAD_OF_HANDICAPPER . "
                )
            WHERE
                {$this->getRestrictions(self::RESTRICTION_OWNER_CHANGE_DATE | self::RESTRICTION_TODAY_DATE)}
            ORDER BY
                prie.horse_uid, prie.race_datetime
        ";

        return $this->getResult(
            $sql,
            [
                'horse_uid',
                'saddle_cloth_no',
                'horse_style_name',
                'horse_country_origin_code',
                'entries(\Api\Row\Signposts)' => [
                    'race_datetime',
                    'race_instance_uid',
                    'race_instance_title',
                    'declared_runners',
                    'race_group_desc',
                    'perform_race_uid_atr',
                    'perform_race_uid_ruk',
                    'course_style_name',
                    'course_name',
                    'course_uid',
                    'country_code',
                    'losses_out',
                    'non_runner',
                    'owner_uid',
                    'rp_owner_choice',
                ]
            ],
            [
                'horse_uid'
            ]
        );
    }

    /**
     * @return \Api\Row\Signposts|null
     */
    public function getTravellersCheck()
    {
        $sql = "
            SELECT
                wsd.race_datetime
                , wsd.country_code
                , wsd.course_name
                , wsd.horse_name
                , horse_country_origin_code = prie.horse_country_origin_code
                , wsd.dist_out
                , trav_out = CASE WHEN ISNULL(wsd.meeting, '') = '' THEN NULL ELSE wsd.meeting END
                , all_out = CASE WHEN ISNULL(wsd.meeting_or, '') = '' THEN NULL ELSE wsd.meeting_or END
                , wsd.trainer_name
                , trainer_location = CASE WHEN ISNULL(t.trainer_location, '') = '' THEN NULL ELSE t.trainer_location END
                , wsd.trav_wins
                , wsd.trav_runs
                , wsd.trav_perc
                , prie.course_uid
                , prie.horse_uid
                , prie.saddle_cloth_no
                , ht.trainer_uid
                , prie.rp_owner_choice
                , prie.owner_uid
                , prie.non_runner
                , prie.race_instance_uid
                , prie.race_instance_title
                , declared_runners = prie.pri_no_of_runners
                , prie.race_group_desc
                , prie.perform_race_uid_atr
                , prie.perform_race_uid_ruk
            FROM
                {$this->getFactoryTmpSignpostsTables()->getPreRaceInstanceExtended($this->getRequest())} prie
                JOIN horse_trainer ht
                    ON prie.horse_uid = ht.horse_uid
                JOIN trainer t
                    ON t.trainer_uid = ht.trainer_uid
                JOIN {$this->getFactoryTmpSignpostsTables()->getWorkSignpostsDataToday()} wsd
                    ON  wsd.type = " . WsdTable::TRAVELLERS_CHECK . " AND
                        wsd.race_datetime = prie.race_datetime AND
                        wsd.course_name = prie.course_style_name AND
                        wsd.horse_name = prie.horse_style_name AND
                        wsd.trainer_name = t.style_name
            WHERE
                {$this->getRestrictions(self::RESTRICTION_OWNER_CHANGE_DATE | self::RESTRICTION_TRAINER_CHANGE_DATE | self::RESTRICTION_TODAY_DATE)}
            ORDER BY
                prie.race_datetime, prie.course_uid, wsd.dist_out desc, ht.trainer_uid
        ";

        return $this->getResult($sql, null, 'horse_uid');
    }

    /**
     * @return \Api\Row\Signposts|null
     */
    public function getFirstTimeBlinkers()
    {
        $sql = "
            SELECT
                prie.horse_uid
                , prie.saddle_cloth_no
                , prie.horse_name
                , prie.race_datetime
                , prie.race_instance_uid
                , prie.race_instance_title
                , declared_runners = prie.pri_no_of_runners
                , prie.race_group_desc
                , prie.perform_race_uid_atr
                , prie.perform_race_uid_ruk
                , prie.course_uid
                , prie.course_name
                , prie.course_style_name
                , country_code = prie.course_country_code
                , prie.rp_postmark
                , prie.rp_owner_choice
                , prie.owner_uid
                , first_time_blinkers = hhg.blinkers_yn
                , first_time_visor = hhg.visors_yn
                , first_time_hood = 
                    CASE
                        WHEN CHARINDEX('" . self::FIRST_TIME_HOOD_CHAR . "', hhg.rp_horse_head_gear_code) > 0
                        THEN 'Y'
                        ELSE 'N'
                    END
                , first_tongue_tie =
                    CASE
                        WHEN CHARINDEX('" . self::FIRST_TONGUE_TIE . "', hhg.rp_horse_head_gear_code) > 0
                        THEN 'Y'
                        ELSE 'N'
                    END
                , prie.non_runner
            FROM {$this->getFactoryTmpSignpostsTables()->getPreRaceInstanceExtended($this->getRequest())} prie
                JOIN horse_head_gear hhg
                    ON hhg.horse_head_gear_uid = prie.horse_head_gear_uid
            WHERE
                {$this->getRestrictions(self::RESTRICTION_OWNER_CHANGE_DATE
                 | self::RESTRICTION_COUNTRY_CODES
                 | self::RESTRICTION_TODAY_DATE)}
                AND hhg.first_time_yn = 'Y'
            ORDER BY
                prie.course_name, prie.horse_style_name
        ";

        return $this->getResult($sql, null, 'horse_uid');
    }

    /**
     * @return \Api\Row\Signposts|null
     */
    public function getTopRpr()
    {
        $sql = "
            SELECT TOP {$this->getRequest()->getTopHorses()}
                    prie.horse_uid
                    , prie.saddle_cloth_no
                    , horse_name = prie.horse_style_name
                    , prie.horse_country_origin_code
                    , prie.race_instance_uid
                    , prie.race_datetime
                    , prie.course_uid
                    , country_code = prie.course_country_code
                    , course_name = prie.course_style_name
                    , prie.rp_postmark
                    , prie.owner_uid
                    , prie.rp_owner_choice
                    , prie.non_runner
                    , prie.race_instance_uid
                    , prie.race_instance_title
                    , declared_runners = prie.pri_no_of_runners
                    , prie.race_group_desc
                    , prie.perform_race_uid_atr
                    , prie.perform_race_uid_ruk
                FROM
                    {$this->getFactoryTmpSignpostsTables()->getPreRaceInstanceExtended($this->getRequest())} prie
                WHERE
                    {$this->getRestrictions(self::RESTRICTION_OWNER_CHANGE_DATE_MIN
                     | self::RESTRICTION_RACE_STATUS_CODE
                     | self::RESTRICTION_COUNTRY_CODES
                     | self::RESTRICTION_TODAY_DATE)}
                ORDER BY
                    prie.rp_postmark DESC
        ";

        return $this->getResult($sql, null, 'horse_uid');
    }

    /**
     * @return array
     */
    protected function getEntries()
    {
        return [
            'race_datetime',
            'race_instance_uid',
            'race_instance_title',
            'declared_runners',
            'race_group_desc',
            'perform_race_uid_atr',
            'perform_race_uid_ruk',
            'horse_name',
            'horse_uid',
            'horse_country_origin_code',
            'course_name',
            'course_uid',
            'country_code',
            'owner_uid',
            'rp_owner_choice',
            'saddle_cloth_no',
            'non_runner'
        ];
    }

    /**
     * @param int $binaryFlags
     *
     * @return string
     */
    private function getRestrictions($binaryFlags)
    {
        $this->restrictions = [];
        if ($binaryFlags & self::RESTRICTION_RACE_STATUS_CODE) {
            $this->restrictions[] = "
                    CASE
                        WHEN prie.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . " THEN 1
                        ELSE CASE 
                            WHEN prie.race_status_code = " . Constants::RACE_STATUS_CALENDAR . "
                            THEN 7
                            ELSE CAST(prie.race_status_code AS INT)
                        END
                    END = (SELECT MIN(
                                CASE
                                    WHEN race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . " THEN 1
                                    ELSE CASE
                                        WHEN race_status_code = " . Constants::RACE_STATUS_CALENDAR . "
                                        THEN 7 ELSE CAST(race_status_code AS INT)
                                    END
                                END)
                            FROM pre_horse_race
                            WHERE race_instance_uid = prie.race_instance_uid AND horse_uid = prie.horse_uid
                            GROUP BY race_instance_uid)
            ";
        }
        if ($binaryFlags & self::RESTRICTION_OWNER_CHANGE_DATE_MIN) {
            $this->restrictions[] = "
                prie.owner_change_date = (
                    SELECT MIN(owner_change_date)
                    FROM horse_owner
                    WHERE horse_uid = prie.horse_uid
                    AND (owner_change_date >= prie.race_datetime OR owner_change_date <= '1/2/1900')
                )
            ";
        }
        if ($binaryFlags & self::RESTRICTION_OWNER_CHANGE_DATE) {
            $this->restrictions[] = "prie.owner_change_date = '" . Constants::EMPTY_DATE . "'";
        }
        if ($binaryFlags & self::RESTRICTION_TRAINER_CHANGE_DATE) {
            $this->restrictions[] = "ht.trainer_change_date = '" . Constants::EMPTY_DATE . "'";
        }
        if ($binaryFlags & self::RESTRICTION_COUNTRY_CODES) {
            $this->restrictions[] = "prie.course_country_code IN ('GB', 'IRE')";
        }
        if ($binaryFlags & self::RESTRICTION_TODAY_DATE) {
            $this->placeholders['upcomingRestrictionDateStart'] = date('Y-m-d 00:00:00');
            $this->placeholders['upcomingRestrictionDateEnd'] = date('Y-m-d 23:59:59');
            $this->restrictions[] =
                "prie.race_datetime BETWEEN :upcomingRestrictionDateStart AND :upcomingRestrictionDateEnd";
        }
        if ($this->getRequest()->isParameterProvided('raceType')) {
            $this->restrictions[] = "prie.race_type_code IN ('"
                . implode(
                    "', '",
                    $this->getRequest()->getRaceTypeCodes()
                )
                . "') ";
        }
        if ($this->getRequest()->isParameterSet('dist')) {
            $this->restrictions[] = "wsd.dist >= " . $this->getRequest()->getDist();
        }
        return implode(" AND ", $this->restrictions);
    }

    /**
     * @param string     $sql
     * @param array|null $structure
     * @param array|null $keys
     *
     * @return array|null
     */

    private function getResult($sql, $structure = null, $keys = null)
    {
        $rows = $this->query($sql, array_merge($this->parameters, $this->placeholders), new Row());
        $this->placeholders = [];

        if ($structure) {
            $groupedResult = $rows->getGroupedResult($structure, $keys);
        } else {
            $groupedResult = $rows->toArrayWithRows($keys);
        }

        return $groupedResult ?: null;
    }

    /**
     * @var string[]
     */
    protected $restrictions = [];

    /**
     * @var string[]
     */
    protected $parameters = [];

    /**
     * @var \Api\Input\Request\HorsesRequest
     */
    private $request;

    /**
     * @var \Api\DataProvider\Factory\TmpSignpostsTables
     */
    private $factoryTmpSignpostsTables;
}
