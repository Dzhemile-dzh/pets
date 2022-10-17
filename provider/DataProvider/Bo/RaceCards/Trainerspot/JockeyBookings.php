<?php

namespace Api\DataProvider\Bo\RaceCards\Trainerspot;

use Api\DataProvider\HorsesDataProvider;
use Models\Selectors;
use Phalcon\Db\Sql\Builder;
use Api\Mvc\DataProvider\BuilderBasedTemporaryTable as TmpBuilder;
use Api\Constants\Horses as Constants;

/**
 * Class JockeyBookings
 *
 * @package Api\DataProvider\Bo\RaceCards\Trainerspot
 */
class JockeyBookings extends HorsesDataProvider
{
    /**
     * Seasons limit in years
     */
    const SEASONS_YEARS_LIMIT = 4;

    /**
     * Temporary table base name for today races
     */
    const TMP_TABLE_BASE_NAME_TODAY_RACES = 'JockeyBookingsTodayRaces';

    /**
     * Temporary table base name for today races
     */
    const TMP_TABLE_BASE_NAME_MIXED_COURSES = 'JockeyBookingsMixedCourses';

    /**
     * Non mixed courses
     */
    const NON_MIXED_COURSES = [1353];

    /**
     * Temporary table object for today races
     *
     * @var TmpBuilder|null
     */
    private $tmpTableTodayRaces = null;

    /**
     * Temporary table object for mixed courses
     *
     * @var TmpBuilder|null
     */
    private $tmpTableMixedCourses = null;

    /**
     * Current date
     *
     * @var object
     */
    private $currentDate;

    /**
     * Request
     *
     * @var
     */
    private $request;

    /**
     * Season object
     *
     * @var object
     */
    private $season;

    /**
     * JockeyBookings constructor.
     */
    public function __construct()
    {
        $this->setCurrentDate();
    }

    /**
     * @return Selectors
     */
    protected function getSelectors()
    {
        return $this->getDI()->getShared('selectors');
    }

    /**
     * @return TmpBuilder|null
     * @throws \Exception
     */
    public function getTmpTableTodayRaces(): TmpBuilder
    {
        if (!isset($this->tmpTableTodayRaces)) {
            $this->tmpTableTodayRaces = $this->createTodayRacesTable();
        }

        return $this->tmpTableTodayRaces;
    }

    /**
     * @return TmpBuilder|null
     * @throws \Exception
     */
    public function getTmpTableMixedCourses(): TmpBuilder
    {
        if (!isset($this->tmpTableMixedCourses)) {
            $this->tmpTableMixedCourses = $this->createMixedCoursesTable();
        }

        return $this->tmpTableMixedCourses;
    }

    /**
     * Current date getter
     *
     * @return object
     */
    public function getCurrentDate()
    {
        return $this->currentDate;
    }

    /**
     * Current date setter
     */
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
     * @return null|\Phalcon\Mvc\ModelInterface
     * @throws \Exception
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getSeason()
    {
        if (!isset($this->season)) {
            $this->season = new \stdClass();
            $selectors = $this->getSelectors();
            $raceType = $this->getRequest()->getRaceType();

            $sql = "
                SELECT TOP 1
                    countryCode = 'GB',
                    curSeasonStartDate = cs.season_start_date,
                    last5SeasonStartDate = ls.season_start_date
                FROM season ls
                    JOIN (
                        SELECT
                            season_start_date = MIN(s.season_start_date)
                        FROM season s
                        WHERE
                            getdate() BETWEEN s.season_start_date AND s.season_end_date
                            AND s.season_type_code = :season_type_codeGB
                            AND s.current_season_yn = 'Y'
                        ) cs ON datepart(YEAR, dateadd(YEAR, - :delta, cs.season_start_date)) = datepart(YEAR, ls.season_start_date)
                            AND ls.season_type_code = :season_type_codeGB
            UNION                            
            SELECT TOP 1
                    countryCode = 'IRE',
                    curSeasonStartDate = cs.season_start_date,
                    last5SeasonStartDate = ls.season_start_date
                FROM season ls
                    JOIN (
                        SELECT
                            season_start_date = MIN(s.season_start_date)
                        FROM season s
                        WHERE
                            getdate() BETWEEN s.season_start_date AND s.season_end_date
                            AND s.season_type_code = :season_type_codeIRE
                            AND s.current_season_yn = 'Y'
                        ) cs ON datepart(YEAR, dateadd(YEAR, - :delta, cs.season_start_date)) = datepart(YEAR, ls.season_start_date)
                            AND ls.season_type_code = :season_type_codeIRE                            
            ";
            $res = $this->query(
                $sql,
                [
                    'season_type_codeGB' => $selectors->getSeasonTypeCode('GB', $raceType),
                    'season_type_codeIRE' => $selectors->getSeasonTypeCode('IRE', $raceType),
                    'delta' => $this::SEASONS_YEARS_LIMIT
                ]
            );
            $this->season = $res->toArrayWithRows('countryCode') ?? null;
        }
        return $this->season;
    }

    /**
     * @return TmpBuilder
     * @throws \Exception
     */
    protected function createTodayRacesTable()
    {
        $req = $this->getRequest();
        $selectors = $this->getSelectors();
        $countryCode = $req->getCountryCode();
        $seasonTypeCode = $selectors->getSeasonTypeCode($countryCode, $req->getRaceType());

        $builder = new Builder();
        $builder->setRequest($req);

        $builder->setSqlTemplate("
            SELECT
                ri.course_uid
                , c.rp_abbrev_4
                , course_name = c.style_name
                , ri.race_instance_uid
                , ri.race_datetime
                , phr.jockey_uid
                , jockey_style_name = j.style_name
                , ht.trainer_uid
                , trainer_style_name = t.style_name
                , phr.horse_uid
                , horse_style_name = h.style_name
            INTO " . TmpBuilder::TEMPLATE_FOR_TABLE_NAME . "
            FROM
                race_instance ri
                , pre_horse_race phr
                , horse_trainer ht
                , course c
                , horse h
                , jockey j
                , trainer t
                , season s
            WHERE
                ri.race_datetime BETWEEN :dateStart AND :dateEnd
                AND ri.course_uid = c.course_uid
                AND c.country_code IN (:countryCode)
                AND ri.race_type_code IN (:raceTypeCode)
                AND ri.race_instance_uid = phr.race_instance_uid
                AND phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                AND phr.jockey_uid = j.jockey_uid
                AND phr.horse_uid = h.horse_uid
                AND phr.horse_uid = ht.horse_uid
                AND ht.trainer_change_date = '" . Constants::EMPTY_DATE . "'
                AND t.trainer_uid = ht.trainer_uid
                AND isnull(phr.non_runner, 'N') != 'Y'
                AND j.ptp_type_code = 'N'
                AND t.ptp_type_code = 'N'
                AND NOT EXISTS (SELECT 1 FROM trainer_jockey_exclusions tje
                    WHERE t.trainer_uid = tje.trainer_uid AND tje.jockey_uid = j.jockey_uid)
                AND ri.race_datetime BETWEEN s.season_start_date AND s.season_end_date
                AND s.season_type_code = :seasonTypeCode

            PLAN '(use optgoal allrows_dss)(use merge_join off)(nl_join (i_scan ri)(i_scan phr)(i_scan c))'

            CREATE INDEX " . TmpBuilder::TEMPLATE_FOR_TABLE_NAME . "_idx ON " . TmpBuilder::TEMPLATE_FOR_TABLE_NAME . "(
                jockey_uid,
                trainer_uid,
                course_uid,
                rp_abbrev_4
            )
        ");

        $builder
            ->setParam('dateStart', $this->getCurrentDate()->dateStart)
            ->setParam('dateEnd', $this->getCurrentDate()->dateEnd)
            ->setParam('countryCode', $countryCode)
            ->setParam('raceTypeCode', $selectors->getRaceTypeCode($req->getRaceType()))
            ->setParam('seasonTypeCode', $seasonTypeCode);

        return new TmpBuilder($builder, self::TMP_TABLE_BASE_NAME_TODAY_RACES);
    }

    /**
     * @return TmpBuilder
     * @throws \Exception
     */
    protected function createMixedCoursesTable()
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
            SELECT DISTINCT
                ts.course_uid,
                mixed_course_uid = CASE 
                        WHEN ts.course_uid IN (:nonMixedCourses) 
                        THEN ts.course_uid ELSE c.course_uid 
                    END
            INTO " . TmpBuilder::TEMPLATE_FOR_TABLE_NAME . "    
            FROM
                /*{EXPRESSION(tmpTableTodayRaces)}*/ ts
                JOIN course c ON c.rp_abbrev_4 = ts.rp_abbrev_4
        ");
        $builder->expression("tmpTableTodayRaces", $this->getTmpTableTodayRaces()->getTemporaryTable());
        $builder->setParam('nonMixedCourses', self::NON_MIXED_COURSES);

        return new TmpBuilder($builder, self::TMP_TABLE_BASE_NAME_MIXED_COURSES);
    }

    /**
     * @return array
     * @throws \Api\Exception\InternalServerError
     * @throws \Exception
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getSeasonsStatsBase()
    {
        $req = $this->getRequest();
        $selectors = $this->getSelectors();
        $season = $this->getSeason();

        if (!$season) {
            return [];
        }

        $builder = new Builder();
        $builder->setRequest($req);

        $builder->setSqlTemplate("
            SELECT
                r.*
            FROM (
                SELECT
                    course_uid,
                    jockey_uid,
                    trainer_uid,
            
                    wins = isnull(SUM(CASE WHEN isCurSeason = 1 THEN wins END), 0),
                    runs = isnull(SUM(CASE WHEN isCurSeason = 1 THEN 1 END), 0),
                    stake = isnull(SUM(CASE WHEN isCurSeason = 1 THEN stake END), 0),
            
                    wins5 = SUM(wins),
                    runs5 = COUNT(*),
                    stake5 = SUM(stake),
            
                    winsCourse = isnull(SUM(CASE WHEN isCurCourse = 1 AND isCurSeason = 1 THEN wins END), 0),
                    runsCourse = isnull(COUNT(CASE WHEN isCurCourse = 1 AND isCurSeason = 1 THEN 1 END), 0),
                    stakeCourse = isnull(SUM(CASE WHEN isCurCourse = 1 AND isCurSeason = 1 THEN stake END), 0),
            
                    winsCourse5 = isnull(SUM(CASE WHEN isCurCourse = 1 THEN wins END), 0),
                    runsCourse5 = isnull(COUNT(CASE WHEN isCurCourse = 1 THEN 1 END), 0),
                    stakeCourse5 = isnull(SUM(CASE WHEN isCurCourse = 1 THEN stake END), 0)
                FROM (
                    SELECT
                        isCurSeason = CASE WHEN sst.race_datetime > :curSeasonStartGB THEN 1 ELSE 0 END,
                        isCurCourse = (CASE WHEN ri.course_uid IN (
                            SELECT c.mixed_course_uid
                            FROM /*{EXPRESSION(tmpTableMixedCourses)}*/ c
                            WHERE c.course_uid = tr.course_uid
                            ) THEN 1 ELSE 0 END),
                        tr.course_uid,
                        sst.jockey_uid,
                        sst.trainer_uid,
                        sst.wins,
                        sst.runs,
                        sst.stake
                    FROM
                        /*{EXPRESSION(workHorseDB)}*/..sstats_horse_own_jock_train sst
                        JOIN race_instance ri ON ri.race_instance_uid = sst.race_instance_uid
                            AND ri.race_datetime = sst.race_datetime
                            AND ri.race_type_code = sst.race_type_code
                        JOIN (
                            SELECT DISTINCT
                                jb.course_uid,
                                jb.jockey_uid,
                                jb.trainer_uid
                            FROM /*{EXPRESSION(tmpTableTodayRaces)}*/ jb
                            ) tr ON tr.jockey_uid = sst.jockey_uid
                            AND tr.trainer_uid = sst.trainer_uid
                    WHERE
                        sst.race_datetime BETWEEN :last5SeasonStartGB AND getDate()
                        AND sst.race_type_code IN (:raceTypeCodes)
                        AND sst.country_code = 'GB'

                    UNION ALL
                        
                    SELECT
                        isCurSeason = CASE WHEN sst.race_datetime > :curSeasonStartIRE THEN 1 ELSE 0 END,
                        isCurCourse = (CASE WHEN ri.course_uid IN (
                            SELECT c.mixed_course_uid
                            FROM /*{EXPRESSION(tmpTableMixedCourses)}*/ c
                            WHERE c.course_uid = tr.course_uid
                            ) THEN 1 ELSE 0 END),
                        tr.course_uid,
                        sst.jockey_uid,
                        sst.trainer_uid,
                        sst.wins,
                        sst.runs,
                        sst.stake
                    FROM
                        /*{EXPRESSION(workHorseDB)}*/..sstats_horse_own_jock_train sst
                        JOIN race_instance ri ON ri.race_instance_uid = sst.race_instance_uid
                            AND ri.race_datetime = sst.race_datetime
                            AND ri.race_type_code = sst.race_type_code
                        JOIN (
                            SELECT DISTINCT
                                jb.course_uid,
                                jb.jockey_uid,
                                jb.trainer_uid
                            FROM /*{EXPRESSION(tmpTableTodayRaces)}*/ jb
                            ) tr ON tr.jockey_uid = sst.jockey_uid
                            AND tr.trainer_uid = sst.trainer_uid
                    WHERE
                        sst.race_datetime BETWEEN :last5SeasonStartIRE AND getDate()
                        AND sst.race_type_code IN (:raceTypeCodes)
                        AND sst.country_code = 'IRE'                      
                    ) ts
                GROUP BY
                    course_uid,
                    jockey_uid,
                    trainer_uid
                ) r
            WHERE (r.wins > 1 OR r.wins5 > 1 OR r.winsCourse > 1 OR r.winsCourse5 > 1)
                AND (r.stake >= 1 OR r.stake5 >= 1 OR r.stakeCourse >= 1 OR r.stakeCourse5 >= 1)

            PLAN '(use optgoal allrows_dss)(use merge_join off)(h_join (i_scan jb)(i_scan sst))'
        ");

        $builder->expression("tmpTableTodayRaces", $this->getTmpTableTodayRaces()->getTemporaryTable());
        $builder->expression("tmpTableMixedCourses", $this->getTmpTableMixedCourses()->getTemporaryTable());
        $builder->expression("workHorseDB", $selectors->getDb()->getWorkHorseDb());

        $builder
            ->setParam("curSeasonStartGB", $season['GB']->curSeasonStartDate)
            ->setParam('last5SeasonStartGB', $season['GB']->last5SeasonStartDate)
            ->setParam("curSeasonStartIRE", $season['IRE']->curSeasonStartDate)
            ->setParam('last5SeasonStartIRE', $season['IRE']->last5SeasonStartDate)
            ->setParam('raceTypeCodes', $selectors->getRaceTypeCode($req->getRaceType()));

        $structure = [
            'course_uid',
            'jockeys' => [
                'jockey_uid',
                'trainers' => [
                    'trainer_uid',
                    'wins',
                    'runs',
                    'stake',
                    'wins5',
                    'runs5',
                    'stake5',
                    'winsCourse',
                    'runsCourse',
                    'stakeCourse',
                    'winsCourse5',
                    'runsCourse5',
                    'stakeCourse5'
                ]
            ]
        ];
        $keys = [
            'course_uid',
            'jockey_uid',
            'trainer_uid'
        ];
        $collection = $this->queryBuilder($builder);

        return $collection->getGroupedResult($structure, $keys);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getTodayRaces()
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
            SELECT 
                course_uid,
                course_name,
                jockey_uid,
                jockey_style_name,
                trainer_uid,
                trainer_style_name,
                horse_uid,
                horse_style_name,
                race_instance_uid,
                race_datetime
            FROM
               /*{EXPRESSION(tmpTableTodayRaces)}*/
            ORDER BY
                course_uid
                , jockey_uid
                , trainer_uid
                , race_datetime
                , horse_style_name
        ");

        $builder->expression("tmpTableTodayRaces", $this->getTmpTableTodayRaces()->getTemporaryTable());

        $collection = $this->queryBuilder($builder);
        $structure = [
            'course_uid',
            'course_name',
            'jockeys' => [
                'jockey_uid',
                'jockey_style_name',
                'trainers' => [
                    'trainer_uid',
                    'trainer_style_name',
                    'runners' => [
                        'horse_uid',
                        'horse_style_name',
                        'race_instance_uid',
                        'race_datetime'
                    ]
                ]
            ]
        ];
        $keys = [
            'course_uid',
            'jockey_uid',
            'trainer_uid'
        ];

        return $collection->getGroupedResult($structure, $keys);
    }
}
