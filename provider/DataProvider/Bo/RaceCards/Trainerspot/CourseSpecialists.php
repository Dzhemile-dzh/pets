<?php

namespace Api\DataProvider\Bo\RaceCards\Trainerspot;

use Api\Constants\Horses as Constants;
use Api\DataProvider\HorsesDataProvider;
use Models\Selectors;
use Phalcon\Db\Sql\Builder;
use Api\Mvc\DataProvider\BuilderBasedTemporaryTable as TmpBuilder;

/**
 * Class CourseSpecialists
 *
 * @package Api\DataProvider\Bo\RaceCards\Trainerspot
 */
class CourseSpecialists extends HorsesDataProvider
{
    /**
     * Seasons limit in years
     */
    const SEASONS_YEARS_LIMIT = 4;

    /**
     * Temporary table base name for today races
     */
    const TMP_TABLE_BASE_NAME_TODAY_RACES = 'CourseSpecialistsTodayRaces';

    /**
     * @return Selectors
     */
    protected function getSelectors()
    {
        return $this->getDI()->getShared('selectors');
    }

    /**
     * Temporary table object for today races
     *
     * @var TmpBuilder|null
     */
    private $tmpTableTodayRaces = null;

    /**
     * @return TmpBuilder|null
     * @throws \Exception
     */
    public function getTmpTableTodayRaces(): TmpBuilder
    {
        if (!isset($this->tmpTableTodayRaces)) {
            $this->tmpTableTodayRaces = $this->createCourseSpecialistsTempTables();
        }

        return $this->tmpTableTodayRaces;
    }

    /**
     * Current date
     *
     * @var
     */
    private $currentDate;

    /**
     * Request
     *
     * @var
     */
    private $request;

    /**
     * Sql filters for flat races
     *
     * @var array
     */
    private $flatFilters = [
        0 => [
            'description' => '2yo non-hcp',
            'conditions' => '
                sst.race_group_uid NOT IN (5,6,11,12,13,14,15,16)
                AND horse_age = 2'
        ],
        1 => [
            'description' => '2yo hcp',
            'conditions' => '
                sst.race_group_uid IN (5,6,11,12,13,14,15,16)
                AND horse_age = 2'
        ],
        2 => [
            'description' => '3yo hcp',
            'conditions' => '
                sst.race_group_uid IN (5,6,11,12,13,14,15,16)
                AND ages_allowed_uid = 3'
        ],
        3 => [
            'description' => '3yo+ hcp',
            'conditions' => '
                sst.race_group_uid IN (5,6,11,12,13,14,15,16)
                AND horse_age >= 3
                AND ages_allowed_uid != 3'
        ],
        4 => [
            'description' => 'sell',
            'conditions' => '
                sst.race_group_uid IN (5,6,11,12,13,14,15,16)
                AND charindex(' . Constants::RACE_TYPE_SELLING . ',upper(race_instance_title)) > 0',
        ],
        5 => [
            'description' => 'Group/Listed',
            'conditions' => '
                sst.race_group_uid IN (1,2,3,4,5,7,8,9,11,12,13,14,15,16)'
        ],
        6 => [
            'description' => 'claim',
            'conditions' => '
                charindex(' . Constants::RACE_TYPE_CLAIMING . ',upper(race_instance_title)) > 0'
        ],
        7 => [
            'description' => '3yo maiden',
            'conditions' => '
                ages_allowed_uid = 3
                AND charindex(' . Constants::RACE_TYPE_MAIDEN . ',upper(race_instance_title)) > 0'
        ],
        8 => [
            'description' => '3yo+ maiden',
            'conditions' => '
                horse_age >= 3
                AND ages_allowed_uid != 3
                AND charindex(' . Constants::RACE_TYPE_MAIDEN . ',upper(race_instance_title)) > 0'
        ],
        9 => [
            'description' => '3yo class/cond',
            'conditions' => '
                ages_allowed_uid = 3
                AND (charindex(' . Constants::RACE_TYPE_CLASSIFIED . ',upper(race_instance_title)) > 0
                    OR charindex(' . Constants::RACE_TYPE_CONDITIONS . ',upper(race_instance_title)) > 0)'
        ],
        10 => [
            'description' => '3yo+ class/cond',
            'conditions' => '
                horse_age >= 3
                AND ages_allowed_uid != 3
                AND (charindex(' . Constants::RACE_TYPE_CLASSIFIED . ',upper(race_instance_title)) > 0
                    OR charindex(' . Constants::RACE_TYPE_CONDITIONS . ',upper(race_instance_title)) > 0)'
        ]
    ];

    /**
     * Sql filters for jumps races
     *
     * @var array
     */
    private $jumpsFilters = [
        0 => [
            'description' => 'hcp hdl',
            'conditions' => '
                sst.race_group_uid IN (5,6,11,12,13,14,15,16)
                AND sst.race_type_code = ' . Constants::RACE_TYPE_HURDLE_TURF
        ],
        1 => [
            'description' => 'nov hdl',
            'conditions' => '
                charindex(' . Constants::RACE_TYPE_NOVICE . ',upper(race_instance_title)) > 0
                AND charindex(' . Constants::RACE_TYPE_JUVENILE . ',upper(race_instance_title)) = 0
                AND sst.race_type_code = ' . Constants::RACE_TYPE_HURDLE_TURF . '
                AND sst.race_group_uid not in (5,6,11,12,13,14,15,16)'
        ],
        2 => [
            'description' => 'juv hdl',
            'conditions' => '
                horse_age = 3
                AND sst.race_type_code = ' . Constants::RACE_TYPE_HURDLE_TURF . '
                AND sst.race_group_uid not in (5,6,11,12,13,14,15,16)'
        ],
        3 => [
            'description' => 'Gd 1-3 hdl',
            'conditions' => '
                sst.race_group_uid in (1,2,3,4,5,7,8,9,11,12,13,14,15,16)
                AND sst.race_type_code in (' . Constants::RACE_TYPE_HURDLE . ')'
        ],
        4 => [
            'description' => 'sell/claim hdl',
            'conditions' => '
                sst.race_type_code in (' . Constants::RACE_TYPE_HURDLE . ')
                AND (charindex(' . Constants::RACE_TYPE_SELLING . ',upper(race_instance_title)) > 0
                    OR charindex(' . Constants::RACE_TYPE_CLAIMING . ',upper(race_instance_title)) > 0)'
        ],
        5 => [
            'description' => 'NH Flat',
            'conditions' => '
                sst.race_type_code = ' . Constants::RACE_TYPE_NH_FLAT
        ],
        6 => [
            'description' => 'hcp ch',
            'conditions' => '
                sst.race_type_code in (' . Constants::RACE_TYPE_CHASE_TURF . ',' . Constants::RACE_TYPE_CHASE_AW . ')
                AND sst.race_group_uid in (5,6,11,12,13,14,15,16)'
        ],
        7 => [
            'description' => 'nov ch',
            'conditions' => '
                sst.race_type_code in (' . Constants::RACE_TYPE_CHASE_TURF . ',' . Constants::RACE_TYPE_CHASE_AW . ')
                AND sst.race_group_uid not in (5,6,11,12,13,14,15,16)
                AND charindex(' . Constants::RACE_TYPE_NOVICE . ',upper(race_instance_title)) > 0'
        ],
        8 => [
            'description' => 'sell/claim ch',
            'conditions' => '
                sst.race_type_code in (' . Constants::RACE_TYPE_CHASE_TURF . ',' . Constants::RACE_TYPE_CHASE_AW . ')
                AND (charindex(' . Constants::RACE_TYPE_SELLING . ',upper(race_instance_title)) > 0
                    OR charindex(' . Constants::RACE_TYPE_CLAIMING . ',upper(race_instance_title)) > 0)'
        ],
        9 => [
            'description' => 'Gd 1-3 ch',
            'conditions' => '
                sst.race_type_code in (' . Constants::RACE_TYPE_CHASE_TURF . ',' . Constants::RACE_TYPE_CHASE_AW . ')
                AND sst.race_group_uid in (1,2,3,4,5,7,8,9,11,12,13,14,15,16)'
        ],
        10 => [
            'description' => 'hunter-ch',
            'conditions' => '
                sst.race_type_code = ' . Constants::RACE_TYPE_HUNTER_CHASE
        ],
    ];

    /**
     * CourseSpecialists constructor.
     */
    public function __construct()
    {
        $this->setCurrentDate();
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
     * @return string
     */
    protected function getCategoriesSql()
    {
        $categories = $this->getRequest()->getRaceType() == Constants::RACE_TYPE_FLAT_ALIAS
            ? $this->flatFilters
            : $this->jumpsFilters;

        if (empty($categories)) {
            return '';
        }

        $sql = 'CASE ';
        foreach ($categories as $category) {
            $sql .= ' WHEN ' . $category['conditions'] . "
                      THEN '" . $category['description'] . "'";
        }
        return $sql . ' END';
    }

    /**
     * @param string $seasonTypeCode
     *
     * @return array|null
     * @throws \Exception
     */
    protected function getCurrentSeasonStartDate($seasonTypeCode)
    {
        $sql = "
            SELECT TOP 1
                season_start_date
            FROM season
            WHERE
                getdate() BETWEEN season_start_date AND season_end_date
                AND season_type_code = :season_type_code
                AND current_season_yn = 'Y'
        ";
        $res = $this->query(
            $sql,
            [
                'season_type_code' => $seasonTypeCode
            ]
        );
        $result = $res->getField('season_start_date');

        return !empty($result) && !empty($result[0]) ? $result[0] : null;
    }

    /**
     * @param string $seasonTypeCode
     * @param string $currentSeasonStart
     * @param int    $delta
     *
     * @return array|null
     * @throws \Exception
     */
    protected function getLastSeasonsStartDate($seasonTypeCode, $currentSeasonStart, $delta)
    {
        $sql = "
            SELECT TOP 1
                season_start_date
            FROM season
            WHERE datepart(YEAR,dateadd(YEAR, -:delta, :current_season_start)) = datepart(YEAR,season_start_date)
               AND season_type_code = :season_type_code
        ";
        $res = $this->query(
            $sql,
            [
                'season_type_code' => $seasonTypeCode,
                'current_season_start' => $currentSeasonStart,
                'delta' => $delta
            ]
        );
        $result = $res->getField('season_start_date');

        return !empty($result) && !empty($result[0]) ? $result[0] : null;
    }

    /**
     * @return TmpBuilder
     * @throws \Exception
     */
    protected function createCourseSpecialistsTempTables()
    {
        $req = $this->getRequest();
        $selectors = $this->getSelectors();
        $countryCode = $req->getCountryCode();
        $dateStart = $this->getCurrentDate()->dateStart;
        $dateEnd = $this->getCurrentDate()->dateEnd;
        $seasonTypeCode = $selectors->getSeasonTypeCode($countryCode, $req->getRaceType());

        $builder = new Builder();
        $builder->setRequest($req);

        $builder->setSqlTemplate("
            SELECT
                m.*
            INTO " . TmpBuilder::TEMPLATE_FOR_TABLE_NAME . "
            FROM (
                SELECT
                    sst.*
                    , categoryId = (/*{EXPRESSION(categoriesSQL)}*/)
                FROM
                    (SELECT
                        ri.course_uid
                        , c.course_name
                        , ri.race_instance_uid
                        , ri.race_datetime
                        , ri.race_group_uid
                        , ri.race_instance_title
                        , ri.race_type_code
                        , ht.trainer_uid
                        , trainer_style_name = t.style_name
                        , phr.horse_uid
                        , horse_style_name = h.style_name
                        , horse_age = datediff(YY, h.horse_date_of_birth, s.season_start_date)
                        , ri.ages_allowed_uid
                        , s.season_start_date
                    FROM
                        race_instance ri
                        , pre_horse_race phr
                        , horse_trainer ht
                        , course c
                        , horse h
                        , trainer t
                        , season s
                    WHERE
                        ri.race_datetime BETWEEN :dateStart AND :dateEnd
                        AND ri.course_uid = c.course_uid
                        AND c.country_code IN (:countryCode)
                        AND ri.race_type_code IN (:raceTypeCode)
                        AND ri.race_instance_uid = phr.race_instance_uid
                        AND phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                        AND phr.horse_uid = h.horse_uid
                        AND phr.horse_uid = ht.horse_uid
                        AND ht.trainer_change_date = '" . Constants::EMPTY_DATE . "'
                        AND t.trainer_uid = ht.trainer_uid
                        AND ri.race_datetime BETWEEN s.season_start_date AND s.season_end_date
                        AND s.season_type_code = :seasonTypeCode
                    ) sst
                ) m
            WHERE
                m.categoryId IS NOT NULL

            PLAN '(use optgoal allrows_dss)(use merge_join off)(nl_join (i_scan ri)(i_scan phr)(i_scan c))'

            CREATE INDEX " . TmpBuilder::TEMPLATE_FOR_TABLE_NAME . "_idx ON " . TmpBuilder::TEMPLATE_FOR_TABLE_NAME . "(
                course_uid, trainer_uid, categoryId
            )
        ");

        $builder->expression("categoriesSQL", $this->getCategoriesSql());

        $builder
            ->setParam('dateStart', $dateStart)
            ->setParam('dateEnd', $dateEnd)
            ->setParam('countryCode', $countryCode)
            ->setParam('raceTypeCode', $selectors->getRaceTypeCode($req->getRaceType()))
            ->setParam('seasonTypeCode', $seasonTypeCode);

        return new TmpBuilder($builder, self::TMP_TABLE_BASE_NAME_TODAY_RACES);
    }

    /**
     * @return array
     * @throws \Api\Exception\InternalServerError
     * @throws \Exception
     */
    public function getSeasonsStats()
    {
        $req = $this->getRequest();
        $selectors = $this->getSelectors();

        $countryCode = $req->getCountryCode();
        $seasonTypeCode = $selectors->getSeasonTypeCode($countryCode, $req->getRaceType());
        $curSeasonStartDate = $this->getCurrentSeasonStartDate($seasonTypeCode);
        $last5SeasonStartDate = $this->getLastSeasonsStartDate(
            $seasonTypeCode,
            $curSeasonStartDate,
            $this::SEASONS_YEARS_LIMIT
        );

        $builder = new Builder();
        $builder->setRequest($req);

        $builder->setSqlTemplate("
            SELECT
                course_uid
                , trainer_uid
                , trainer_style_name                
                , categoryId
                , wins = SUM(CASE WHEN isCurSeason = 1 THEN wins END)
                , runs = SUM(CASE WHEN isCurSeason = 1 THEN 1 END)
                , stake = SUM(CASE WHEN isCurSeason = 1 THEN stake END)
                , wins5 = SUM(wins)
                , runs5 = COUNT(*)
                , stake5 = SUM(stake)
            FROM (
                SELECT
                    isCurSeason = CASE WHEN sst.race_datetime > :curSeasonStart THEN 1 ELSE 0 END,
                    ri.course_uid,
                    sst.race_instance_uid,
                    categoryId = (/*{EXPRESSION(categoriesSQL)}*/),
                    sst.trainer_uid,
                    sst.trainer_style_name,
                    sst.wins,
                    sst.runs,
                    sst.stake,
                    sst.horse_uid,
                    sst.horse_style_name
                FROM
                    /*{EXPRESSION(workHorseDB)}*/..sstats_horse_own_jock_train sst
                    JOIN race_instance ri ON ri.race_instance_uid = sst.race_instance_uid
                        AND ri.race_datetime = sst.race_datetime
                        AND ri.race_type_code = sst.race_type_code
                WHERE
                    sst.race_datetime BETWEEN :last5SeasonStart AND getDate()
                    AND sst.race_type_code IN (:raceTypeCodes)
                    AND sst.country_code IN (:countryCodes)
                    AND EXISTS (
                        SELECT 1
                        FROM /*{EXPRESSION(tmpTableTodayRaces)}*/ tr
                        WHERE tr.trainer_uid = sst.trainer_uid
                            AND tr.course_uid = ri.course_uid
                    )
                ) ts
            WHERE categoryId IS NOT NULL
                AND EXISTS (
                    SELECT 1
                    FROM /*{EXPRESSION(tmpTableTodayRaces)}*/ r
                    WHERE r.trainer_uid = ts.trainer_uid
                        AND r.course_uid = ts.course_uid
                        AND r.categoryId = ts.categoryId
                    )
            GROUP BY
                course_uid
                , trainer_uid
                , trainer_style_name
                , categoryId
            HAVING
                (SUM(stake) >= 1 OR SUM(CASE WHEN isCurSeason = 1 THEN stake END) >= 1)
                AND (SUM(CASE WHEN isCurSeason = 1 THEN wins END) > 1 OR SUM(wins) > 1)
            PLAN '(use optgoal allrows_dss)(use merge_join off)(nl_join (i_scan sst)(i_scan ri))'
        ");

        $builder->expression("categoriesSQL", $this->getCategoriesSql());
        $builder->expression("tmpTableTodayRaces", $this->getTmpTableTodayRaces()->getTemporaryTable());
        $builder->expression("workHorseDB", $selectors->getDb()->getWorkHorseDb());

        $builder
            ->setParam("curSeasonStart", $curSeasonStartDate)
            ->setParam('last5SeasonStart', $last5SeasonStartDate)
            ->setParam('raceTypeCodes', $selectors->getRaceTypeCode($req->getRaceType()))
            ->setParam('countryCodes', $countryCode);

        $collection = $this->queryBuilder($builder);

        $structure = [
            'course_uid',
            'trainers' => [
                'trainer_uid',
                'trainer_style_name',
                'description' => [
                    'categoryId',
                    'wins',
                    'runs',
                    'stake',
                    'wins5',
                    'runs5',
                    'stake5'
                ]
            ]
        ];
        $keys = [
            'course_uid',
            'trainer_uid',
            'categoryId'
        ];

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
                trainer_uid,
                trainer_style_name,
                categoryId,
                horse_uid,
                horse_style_name,
                race_instance_uid,
                race_datetime
            FROM
               /*{EXPRESSION(tmpTableTodayRaces)}*/
            WHERE
                categoryId IS NOT NULL
            ORDER BY
                course_uid
                , trainer_uid
                , categoryId
                , race_datetime
                , horse_style_name
        ");

        $builder->expression("tmpTableTodayRaces", $this->getTmpTableTodayRaces()->getTemporaryTable());

        $collection = $this->queryBuilder($builder);
        $structure = [
            'course_uid',
            'course_name',
            'trainers' => [
                'trainer_uid',
                'trainer_style_name',
                'description' => [
                    'categoryId',
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
            'trainer_uid',
            'categoryId'
        ];

        return $collection->getGroupedResult($structure, $keys);
    }
}
