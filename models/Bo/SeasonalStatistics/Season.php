<?php

namespace Models\Bo\SeasonalStatistics;

use Api\Constants\Horses as Constants;
use Api\Input\Request\HorsesRequest;
use Models\Selectors;
use Phalcon\Mvc\Model\Resultset\General as ResultSet;
use Phalcon\Mvc\Model\Row as Row;
use Phalcon\Db\Sql\Builder;

/**
 * Class Season
 * @package Models\Bo\SeasonalStatistics
 */
class Season extends \Models\Season
{
    /**
     * @param HorsesRequest $request
     * @return array
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     * @throws \Exception
     */
    public function getSeason(HorsesRequest $request)
    {
        $sql = "
            SELECT
                season_uid,
                season_start_date,
                season_end_date,
                season_type_code,
                season_desc
            FROM season
            WHERE 
                (YEAR(season_start_date) BETWEEN :seasonYearBegin AND :seasonYearEnd) 
                AND (YEAR(season_end_date) BETWEEN :seasonYearBegin AND :seasonYearEnd)
                AND season_type_code = :seasonTypeCode
            ";

        $result = $this->getReadConnection()->query(
            $sql,
            [
                'seasonYearBegin' => $request->getSeasonYearBegin(),
                'seasonYearEnd' => $request->getSeasonYearEnd(),
                'seasonTypeCode' => $request->getSeasonTypeCode()
            ]
        );

        $result = new ResultSet(null, new Row(), $result);

        return $result->toArrayWithRows();
    }

    /**
     * @param string $seasonTypes
     * @param string $seasonYearBegin
     * @param string $seasonYearEnd
     *
     * @return array|\Phalcon\Mvc\ModelInterface
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getDefaultSeasons($seasonTypes = null, $seasonYearBegin = null, $seasonYearEnd = null)
    {
        $seasonTypes = !$seasonTypes
            ? [
                Constants::getConstantValue(Constants::SEASON_TYPE_CODE_JUMPS),
                Constants::getConstantValue(Constants::SEASON_TYPE_CODE_TURF)
            ]
            : $seasonTypes;

        $sql = "
            SELECT TOP 1
                season_uid,
                season_type_code,
                season_start_date,
                season_end_date,
                season_start_year = YEAR(season_start_date),
                season_end_year = YEAR(season_end_date),
                season_desc,
                sort_order = CASE WHEN getdate() BETWEEN season_start_date AND season_end_date
                    THEN CASE WHEN season_type_code = '" . Constants::SEASON_TYPE_CODE_TURF . "' THEN 1 ELSE 2 END
                    ELSE 3
                END
            FROM season
            WHERE
                season_type_code IN (:seasonTypeCodes)
                AND current_season_yn = 'Y'
            ORDER BY
                sort_order,
                season_end_date DESC
            ";

        $result = $this->getReadConnection()->query($sql, ['seasonTypeCodes' => $seasonTypes]);
        $season = new ResultSet(null, new Row(), $result);

        return $season->getFirst();
    }

    /**
     * @param string $championship
     * @param Selectors $selector
     * @return array
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     * @throws \Exception
     */
    public function getChampionshipsAvailable($championship, Selectors $selector)
    {
        $sql = "
            SELECT
                season_uid,
                season_type_code,
                season_start_date,
                season_end_date,
                season_desc
            FROM season
            WHERE
                season_type_code IN (:seasonTypeCodes)
                AND YEAR(season_start_date) >= " . Constants::SEASON_AVAILABLE_YEAR_BEGIN . "
            ORDER BY
                season_end_date DESC
        ";

        $result = $this->getReadConnection()->query(
            $sql,
            [
                'seasonTypeCodes' => $selector->getAvailableSeasonTypeCodes($championship)
            ]
        );

        $result = new ResultSet(null, new Row(), $result);

        return $result->toArrayWithRows();
    }

    /**
     * @param \Api\Input\Request\Horses\SeasonalStatistics\SeasonsAvailable $request
     * @return array
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getSeasonsAvailable(\Api\Input\Request\Horses\SeasonalStatistics\SeasonsAvailable $request)
    {
        $builder = new Builder();

        $builder->setSqlTemplate(
            "
               SELECT
                   s.season_uid
                   , s.season_type_code
                   , s.season_start_date
                   , s.season_end_date
                   , s.season_desc
                   , is_active = CASE WHEN s.current_season_yn = 'Y' AND s.season_end_date > getdate() THEN 'Y' ELSE 'N' END
                   , st.flat_or_jump_flag
               FROM season s
               JOIN season_type st ON st.season_type_code = s.season_type_code
               WHERE
                   YEAR(s.season_start_date) >= " . Constants::SEASON_AVAILABLE_YEAR_BEGIN . "
                   AND st.flat_or_jump_flag IN ('" . Constants::SEASON_TYPE_CODE_FLAT . "', '"
            . Constants::SEASON_TYPE_CODE_JUMPS . "')
                   /*{WHERE}*/
               ORDER BY
                   season_end_date DESC
            "
        );

        if ($request->isParameterProvided("activeSeasons")) {
            $builder->where("s.current_season_yn = 'Y' AND s.season_end_date > getdate()");
        }

        $builder->build();

        $result = $this->getReadConnection()->query($builder->getSql());
        $result = new ResultSet(null, new Row(), $result);

        return $result->toArrayWithRows();
    }

    /**
     * @param string $seasonTypeCode
     * @param int $seasonYearBegin
     * @param int|null $seasonYearEnd
     * @return \Phalcon\Mvc\ModelInterface
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getSeasonDatesByYearTypeRace(string $seasonTypeCode, int $seasonYearBegin, int $seasonYearEnd = null)
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
            SELECT  
                season_uid,
                season_type_code,
                season_start_date,
                season_end_date,
                season_start_year = YEAR(season_start_date),
                season_end_year = YEAR(season_end_date),
                season_desc
            FROM season
            WHERE
                season_type_code = :seasonTypeCode 
                AND YEAR(season_start_date) = :seasonYearBegin
                /*{WHERE}*/
        ");

        $builder
            ->setParam('seasonTypeCode', $seasonTypeCode)
            ->setParam('seasonYearBegin', $seasonYearBegin);

        if ($seasonYearEnd) {
            $builder->where('YEAR(season_end_date) = :seasonYearEnd');
            $builder->setParam('seasonYearEnd', $seasonYearEnd);
        }

        $builder->build();

        $result = $this->getReadConnection()->query($builder->getSql(), $builder->getParams());
        $season = (new ResultSet(null, new Row(), $result))->getFirst();

        return $season;
    }
}
