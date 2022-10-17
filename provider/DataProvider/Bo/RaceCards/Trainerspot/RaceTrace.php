<?php

namespace Api\DataProvider\Bo\RaceCards\Trainerspot;

use Api\Constants\Horses as Constants;
use Api\DataProvider\HorsesDataProvider;
use Phalcon\Db\Sql\Builder;
use Api\Mvc\DataProvider\BuilderBasedTemporaryTable as TmpBuilder;

/**
 * Class RaceTrace
 *
 * @package Api\DataProvider\Bo\RaceCards\Trainerspot
 */
class RaceTrace extends HorsesDataProvider
{
    const LAST_YEARS_LIMIT = 10;

    /**
     * Minimum wins for a trainer
     */
    const WINS_MIN_LIMIT = 2;

    /**
     * Temporary table base name for previous races
     */
    const TMP_TABLE_BASE_NAME_PREV_RACES = 'RaceTracePrevRaces';

    /**
     * Temporary table base name for trainers
     */
    const TMP_TABLE_BASE_NAME_TRAINERS = 'RaceTraceTrainers';

    private $currentDate;
    private $request;

    /**
     * @var \Models\Selectors
     */
    private $selectors;

    /**
     * Temporary table object for previous races
     *
     * @var TmpBuilder|null
     */
    private $tmpTablePrevRaces = null;

    /**
     * @return TmpBuilder|null
     * @throws \Exception
     */
    public function getTmpTablePrevRaces(): TmpBuilder
    {
        if (!isset($this->tmpTablePrevRaces)) {
            $this->tmpTablePrevRaces = $this->createPrevRacesTempTable();
        }

        return $this->tmpTablePrevRaces;
    }

    /**
     * Temporary table object for trainers
     *
     * @var TmpBuilder|null
     */
    private $tmpTableTrainers = null;

    /**
     * @return TmpBuilder|null
     * @throws \Exception
     */
    public function getTmpTableTrainers(): TmpBuilder
    {
        if (!isset($this->tmpTableTrainers)) {
            $this->tmpTableTrainers = $this->createTrainersTempTable();
        }

        return $this->tmpTableTrainers;
    }

    /**
     * RaceTrace constructor.
     */
    public function __construct()
    {
        $this->setCurrentDate();
    }

    /**
     * @return \Models\Selectors
     */
    public function getSelectors()
    {
        if (!$this->selectors) {
            $this->selectors = $this->getDI()->getShared('selectors');
        }
        return $this->selectors;
    }

    /**
     * @return array
     */
    public function getCurrentDate()
    {
        return $this->currentDate;
    }

    private function setCurrentDate()
    {
        $date = new \stdClass();
        $date->dateStart = (new \DateTime())->format('Y-m-d') . ' 00:00';
        $date->dateEnd = (new \DateTime())->format('Y-m-d') . ' 23:59';

        $this->currentDate = $date;
    }

    /**
     * @param \Api\Input\Request\HorsesRequest $request
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
     * @return array
     */
    public function getTodayRaces()
    {
        $sql = "
            SELECT
                race_instance_uid
            FROM
                race_instance ri
                , course c
            WHERE
                ri.race_datetime BETWEEN :dateStart AND :dateEnd
                AND ri.course_uid = c.course_uid
                AND c.country_code IN (:countryCode)
        ";

        $collection = $this->query(
            $sql,
            [
                'dateStart' => $this->getCurrentDate()->dateStart,
                'dateEnd' => $this->getCurrentDate()->dateEnd,
                'countryCode' => $this->getRequest()->getCountryCode()
            ]
        );

        return $collection->toArrayWithRows('race_instance_uid');
    }

    /**
     * @return TmpBuilder
     */
    protected function createPrevRacesTempTable()
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
            CREATE TABLE " . TmpBuilder::TEMPLATE_FOR_TABLE_NAME . " (
                race_uid INT NULL,
                last_year_race_uid INT NULL,
                last_year_race_datetime DATETIME NULL
            )
        ");

        return new TmpBuilder($builder, self::TMP_TABLE_BASE_NAME_PREV_RACES);
    }

    /**
     * @throws \Api\Exception\ValidationError
     * @throws \Exception
     */
    public function populatePrevRacesTmpTable()
    {
        $prevRacesTableName = $this->getTmpTablePrevRaces()->getTemporaryTable();
        $todayRaces = $this->getTodayRaces();
        $ids = array_keys($todayRaces);
        $lastYearRacesSQL = (new \Bo\LastYearRaces($ids))->getPastRacesSQL(self::LAST_YEARS_LIMIT);

        $sql = "INSERT INTO {$prevRacesTableName} (race_uid, last_year_race_uid, last_year_race_datetime)
                $lastYearRacesSQL
                ";

        $this->execute(
            $sql,
            [
                'raceIDs' => $ids
            ]
        );
    }

    /**
     * @return TmpBuilder
     * @throws \Exception
     */
    public function createTrainersTempTable()
    {
        $builder = new Builder();
        $builder->setRequest($this->getRequest());

        $builder->setSqlTemplate("
            SELECT DISTINCT
                trainer_name = t.style_name
                , ht.trainer_uid
                , phr.horse_uid
                , horse_name = (SELECT h.style_name FROM horse h WHERE h.horse_uid = phr.horse_uid)
                , c.course_uid
                , course_name = c.style_name
                , ri.race_datetime
                , ri.race_instance_uid
                , ri.race_type_code
                , phr.race_status_code
                , past_season_start_date = s.season_start_date
            INTO " . TmpBuilder::TEMPLATE_FOR_TABLE_NAME . "    
            FROM
                race_instance ri
                INNER JOIN pre_horse_race phr ON ri.race_instance_uid = phr.race_instance_uid
                INNER JOIN horse_trainer ht ON phr.horse_uid = ht.horse_uid
                    AND ht.trainer_change_date = isnull(
                            (SELECT MIN(t2.trainer_change_date)
                            FROM horse_trainer t2
                            WHERE t2.horse_uid = phr.horse_uid
                                AND (t2.trainer_change_date > ri.race_datetime)), '" . Constants::EMPTY_DATE . "')
                INNER JOIN trainer t ON ht.trainer_uid = t.trainer_uid
                INNER JOIN course c ON ri.course_uid = c.course_uid
                INNER JOIN season s ON dateadd(YEAR, - :yearsLimit, ri.race_datetime)
                    BETWEEN s.season_start_date AND s.season_end_date
                    AND s.season_type_code =
                    CASE
                        WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                        THEN '" . Constants::SEASON_TYPE_CODE_FLAT . "' 
                        ELSE CASE
                            WHEN c.country_code = 'IRE' 
                            THEN '" . Constants::SEASON_TYPE_CODE_JUMPS_IRE . "'
                            ELSE '" . Constants::SEASON_TYPE_CODE_JUMPS . "'
                        END
                    END
            WHERE
                ri.race_datetime BETWEEN :dateStart AND :dateEnd
                AND phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                AND c.country_code IN (:countryCode)
                AND :winsLimit <= (
                    SELECT
                        COUNT(*)
                    FROM /*{EXPRESSION(tmpTablePrevRaces)}*/ py1
                        , horse_race hr1
                    WHERE py1.race_uid = ri.race_instance_uid
                        AND py1.last_year_race_uid = hr1.race_instance_uid
                        AND hr1.trainer_uid = ht.trainer_uid
                        AND hr1.final_race_outcome_uid IN (" . Constants::WINNER_IDS . ")
                    )
            PLAN '(use optgoal allrows_dss)(nl_join (i_scan ri)(i_scan phr))'
        ");

        $builder->expression("tmpTablePrevRaces", $this->getTmpTablePrevRaces()->getTemporaryTable());

        $builder
            ->setParam('dateStart', $this->getCurrentDate()->dateStart)
            ->setParam('dateEnd', $this->getCurrentDate()->dateEnd)
            ->setParam('winsLimit', self::WINS_MIN_LIMIT)
            ->setParam('yearsLimit', self::LAST_YEARS_LIMIT)
            ->setParam('countryCode', $this->getRequest()->getCountryCode());

        return new TmpBuilder($builder, self::TMP_TABLE_BASE_NAME_TRAINERS);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getCourseTrainerRaces()
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
            SELECT
                t.trainer_name
                , t.trainer_uid
                , t.course_uid
                , t.course_name
                , t.race_datetime
                , t.race_instance_uid
                , t.race_type_code
                , t.past_season_start_date
                , t.horse_uid 
                , t.horse_name 
            FROM
                /*{EXPRESSION(tmpTableTrainers)}*/  t
        ");
        $builder->expression("tmpTableTrainers", $this->getTmpTableTrainers()->getTemporaryTable());
        $res = $this->queryBuilder($builder);

        return $res->getGroupedResult(
            [
                'course_uid',
                'course_name',
                'trainers' => [
                    'trainer_uid',
                    'trainer_name',
                    'races' => [
                        'race_instance_uid',
                        'race_datetime',
                        'race_type_code',
                        'horses' => [
                            'horse_uid',
                            'horse_name'
                        ]
                    ]
                ]
            ],
            [
                'course_uid',
                'trainer_uid',
                'race_instance_uid'
            ]
        );
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getTrainerStats()
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                ss.trainer_uid,
                race_instance_uid = py.race_uid,
                wins = SUM(ss.wins),
                runs = COUNT(ss.runs),
                stake = SUM(ss.stake)
            FROM
                /*{EXPRESSION(workHorseDB)}*/..sstats_horse_own_jock_train ss
                INNER JOIN /*{EXPRESSION(tmpTablePrevRaces)}*/ py ON
                    ss.race_instance_uid = py.last_year_race_uid
                WHERE EXISTS (
                    SELECT 1
                    FROM /*{EXPRESSION(tmpTableTrainers)}*/  ts
                    WHERE
                        ss.trainer_uid = ts.trainer_uid
                        AND ss.race_datetime >= ts.past_season_start_date
                        AND py.race_uid = ts.race_instance_uid
                    )
            GROUP BY
                ss.trainer_uid,
                py.race_uid
        ");
        $builder->expression("tmpTablePrevRaces", $this->getTmpTablePrevRaces()->getTemporaryTable());
        $builder->expression("tmpTableTrainers", $this->getTmpTableTrainers()->getTemporaryTable());
        $builder->expression("workHorseDB", $this->getSelectors()->getDb()->getWorkHorseDb());

        $res = $this->queryBuilder($builder);

        return $res->getGroupedResult(
            [
                'trainer_uid',
                'races' => [
                    'race_instance_uid',
                    'wins',
                    'runs',
                    'stake'
                ]
            ],
            [
                'trainer_uid',
                'race_instance_uid'
            ]
        );
    }

    /**
     * @return array
     * @throws \Api\Exception\InternalServerError
     * @throws \Exception
     */
    public function getTrainerPastPerformance()
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                ss.trainer_uid,
                race_instance_uid = py.race_uid,
                race_year = year(ss.race_datetime),
                hr.horse_uid,
                race_position = 
                    CASE 
                        WHEN ro.race_outcome_position BETWEEN 7 AND 9 
                            THEN CONVERT(CHAR(1), ro.race_outcome_position) 
                        ELSE ro.race_outcome_form_char 
                    END
            FROM
                /*{EXPRESSION(workHorseDB)}*/..sstats_horse_own_jock_train ss
                INNER JOIN /*{EXPRESSION(tmpTablePrevRaces)}*/ py ON
                    ss.race_instance_uid = py.last_year_race_uid
                INNER JOIN horse_race hr ON hr.race_instance_uid = ss.race_instance_uid
                    AND hr.horse_uid = ss.horse_uid
                INNER JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid                    
            WHERE 
                ss.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                AND EXISTS (
                    SELECT 1
                    FROM /*{EXPRESSION(tmpTableTrainers)}*/  ts
                    WHERE
                        ss.trainer_uid = ts.trainer_uid
                        AND ss.race_datetime >= ts.past_season_start_date
                        AND py.race_uid = ts.race_instance_uid
                    )
            ORDER BY
                1, 2, 3    
        ");
        $builder->expression("tmpTablePrevRaces", $this->getTmpTablePrevRaces()->getTemporaryTable());
        $builder->expression("tmpTableTrainers", $this->getTmpTableTrainers()->getTemporaryTable());
        $builder->expression("workHorseDB", $this->getSelectors()->getDb()->getWorkHorseDb());

        $res = $this->queryBuilder($builder);

        return $res->getGroupedResult(
            [
                'trainer_uid',
                'races' => [
                    'race_instance_uid',
                    'years' => [
                        'race_year',
                        'positions' => [
                            'horse_uid',
                            'race_position'
                        ]
                    ]
                ]
            ],
            [
                'trainer_uid',
                'race_instance_uid',
                'race_year'
            ]
        );
    }
}
