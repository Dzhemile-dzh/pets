<?php

namespace Models\Bo\Selectors;

use Api\Exception\ValidationError;
use Phalcon\Mvc\Model\Resultset\General as ResultSet;
use Phalcon\Mvc\Model\Row;
use Phalcon\Db\Sql\Builder;
use Phalcon\DI;
use Api\Constants\Horses as Constants;
use Api\Exception\InternalServerError;
use \Phalcon\Mvc\Model\Resultset\ResultsetException;

class Database extends \Phalcon\Mvc\Model
{
    /**
     * @param int    $seasonYear
     * @param string $seasonTypeCode
     *
     * @return string date
     * @throws ResultsetException
     * @throws ValidationError
     */
    public function getSeasonDateBegin($seasonYear, $seasonTypeCode)
    {
        if (is_null($seasonYear)) {
            throw new ValidationError(10);
        }

        $sql = "
                SELECT 
                  startDate = MIN(season_start_date)
                FROM 
                  season
                WHERE 
                  YEAR(season_start_date) = :seasonYear AND
                  season_type_code = :seasonTypeCode
            ";

        $result = $this->getReadConnection()->query(
            $sql,
            ['seasonYear' => $seasonYear, 'seasonTypeCode' => $seasonTypeCode]
        );
        $result = new ResultSet(null, new Row(), $result);
        $startDate = $result->getFirst()->startDate;
        return $startDate;
    }

    /**
     * @param string $seasonTypeCode
     *
     * @return string
     * @throws ResultsetException
     */
    public function getCurrentSeasonDateBegin($seasonTypeCode)
    {
        $sql = "
                SELECT 
                  startDate = season_start_date
                FROM 
                  season
                WHERE 
                  current_season_yn = 'Y' AND 
                  season_type_code = :seasonTypeCode:
            ";

        $result = $this->getReadConnection()->query($sql, ['seasonTypeCode' => $seasonTypeCode]);
        $result = new ResultSet(null, new Row(), $result);

        return $result->getFirst()->startDate;
    }

    /**
     * @param int    $seasonYear
     * @param string $seasonTypeCode
     *
     * @return string date
     * @throws ResultsetException
     * @throws ValidationError
     */
    public function getSeasonDateEnd($seasonYear, $seasonTypeCode)
    {
        if (is_null($seasonYear)) {
            throw new ValidationError(10);
        }

        $sql = "
                SELECT 
                  endDate = MIN(season_end_date)
                FROM 
                  season
                WHERE 
                  :seasonYear: BETWEEN YEAR(season_start_date) AND YEAR(season_end_date) AND 
                  season_type_code = :seasonTypeCode:
            ";

        $result = $this->getReadConnection()->query(
            $sql,
            ['seasonYear' => $seasonYear, 'seasonTypeCode' => $seasonTypeCode]
        );
        $result = new ResultSet(null, new Row(), $result);
        $endDate = $result->getFirst()->endDate;
        return $endDate;
    }

    /**
     * @param int    $dateBegin
     * @param string $seasonTypeCode
     *
     * @return string date
     * @throws ResultsetException
     * @throws ValidationError
     */
    public function getSeasonDateEndByDateBegin($dateBegin, $seasonTypeCode)
    {
        if (is_null($dateBegin)) {
            throw new ValidationError(10);
        }

        $sql = "
                SELECT 
                  endDate = season_end_date
                FROM 
                  season
                WHERE 
                  season_start_date = :seasonStartDate AND
                  season_type_code = :seasonTypeCode
            ";

        $result = $this->getReadConnection()->query(
            $sql,
            [
                'seasonStartDate' => (new \DateTime($dateBegin))->format('Y-m-d H:i:s'),
                'seasonTypeCode' => $seasonTypeCode
            ]
        );
        $result = new ResultSet(null, new Row(), $result);
        $endDate = $result->getFirst()->endDate;
        return $endDate;
    }

    /**
     * @param string $seasonTypeCode
     *
     * @return string (date)
     * @throws ResultsetException
     */
    public function getCurrentSeasonDateEnd($seasonTypeCode)
    {
        $sql = "
                SELECT 
                  endDate = season_end_date
                FROM 
                  season
                WHERE 
                  current_season_yn = 'Y' AND 
                  season_type_code = :seasonTypeCode
            ";

        $result = $this->getReadConnection()->query($sql, ['seasonTypeCode' => $seasonTypeCode]);
        $result = new ResultSet(null, new Row(), $result);

        return $result->getFirst()->endDate;
    }

    /**
     * @param string $seasonYearBegin
     * @param string $seasonYearEnd
     * @param string $seasonTypeCode
     *
     * @return \Phalcon\Mvc\ModelInterface
     * @throws ResultsetException
     * @throws ValidationError
     */
    public function getOneSeasonData($seasonYearBegin, $seasonYearEnd, $seasonTypeCode)
    {
        $sql = "
            SELECT 
              seasonDateBegin = season_start_date
              , seasonDateEnd = season_end_date
            FROM season
            WHERE
                YEAR(season_start_date) = :seasonYearBegin:
                AND YEAR(season_end_date) = :seasonYearEnd:
                AND season_type_code = :seasonTypeCode:
        ";

        $result = $this->getReadConnection()->query(
            $sql,
            [
                'seasonYearBegin' => $seasonYearBegin,
                'seasonYearEnd' => $seasonYearEnd,
                'seasonTypeCode' => $seasonTypeCode
            ]
        );

        $result = (new ResultSet(null, new Row(), $result))->getFirst();

        if (!$result) {
            throw new ValidationError(17);
        }

        return $result;
    }

    /**
     * @return string
     * @throws InternalServerError
     */
    public function getWorkHorseDb()
    {
        static $workHorseDb = null;
        if (!$workHorseDb) {
            $config = DI::getDefault()->getConfig();
            if (!isset($config->database->workhorse)) {
                throw new InternalServerError(
                    "A variable 'AUTH_DB_WORKHORSE_API_HORSES' is not defined in the server config."
                );
            }
            $workHorseDb = $config->database->workhorse;
        }
        return $workHorseDb;
    }

    /**
     * @return string
     * @throws InternalServerError
     */
    public function getUgcDb()
    {
        static $ugcDb = null;
        if (!$ugcDb) {
            $config = DI::getDefault()->getConfig();
            if (!isset($config->database->ugc)) {
                throw new InternalServerError(
                    "A variable 'AUTH_DB_UGC_API_HORSES' is not defined in the server config."
                );
            }
            $ugcDb = $config->database->ugc;
        }
        return $ugcDb;
    }

    /**
     * @return string
     * @throws InternalServerError
     */
    public function getMetatagsDb()
    {
        static $metatagsDb = null;
        if (!$metatagsDb) {
            $config = DI::getDefault()->getConfig();
            if (!isset($config->database->metatags)) {
                throw new InternalServerError(
                    "A variable 'AUTH_DB_METATAGS_API_HORSES' is not defined in the server config."
                );
            }
            $metatagsDb = $config->database->metatags;
        }
        return $metatagsDb;
    }

    /**
     * @return string
     * @throws InternalServerError
     */
    public function getGlobalHorsesDb()
    {
        static $db = null;
        if (!$db) {
            $config = DI::getDefault()->getConfig();
            if (!isset($config->database->global->horses)) {
                throw new InternalServerError(
                    "A variable 'AUTH_DB_GLOBAL_HORSES_API_HORSES' is not defined in the server config."
                );
            }
            $db = $config->database->global->horses;
        }
        return $db;
    }

    /**
     * @return string
     * @throws InternalServerError
     */
    public function getStoriesDb()
    {
        static $storiesDb = null;
        if (!$storiesDb) {
            $config = DI::getDefault()->getConfig();
            if (!isset($config->database->stories)) {
                throw new InternalServerError(
                    "A variable 'AUTH_DB_STORIES_API_HORSES' is not defined in the server config."
                );
            }
            $storiesDb = $config->database->stories;
        }
        return $storiesDb;
    }

    /**
     * @param string $year in format 'yyyy'
     *
     * @return double
     * @throws ResultsetException
     */
    public function getEuroRateByYear($year)
    {
        $result = $this->getReadConnection()->query(
            "SELECT exchange_rate FROM country_currencies WHERE country_code = 'EUR' AND year = :year:",
            ['year' => (int)$year]
        );
        $resultSet = new ResultSet(null, new Row(), $result);
        $exchangeEuroResult = $resultSet->getFirst();

        return isset($exchangeEuroResult->exchange_rate) ? (double)$exchangeEuroResult->exchange_rate : 1.0;
    }

    /**
     * @param int    $raceId
     * @param string    $countryCode
     *
     * @return array
     */
    public function getTipsQuantity(int $raceId, string $countryCode, array $horseIds)
    {
        $sql = "
            SELECT COUNT(1) as c,
                h.horse_uid
            FROM newspapers np
                INNER JOIN tipster_selection ts ON np.newspaper_uid = ts.newspaper_uid
                INNER JOIN horse h ON h.horse_uid = ts.horse_uid
            WHERE ts.race_instance_uid = :raceId
                AND np.sort_order IS NOT NULL
                AND h.horse_uid IN (:horseIds)
        ";

        switch (trim($countryCode)) {
            case Constants::COUNTRY_GB:
                $where = '
                    AND (
                        np.newspaper_uid BETWEEN 1 AND 10
                        OR np.newspaper_uid IN (12, 40, 57, 70)
                        OR np.newspaper_uid BETWEEN 14 AND 19
                    )
                ';
                break;
            case Constants::COUNTRY_IRE:
                $where = '
                    AND (
                        np.newspaper_uid BETWEEN 90 AND 99
                        OR np.newspaper_uid IN (1, 3, 4, 22, 78, 100, 106)
                    )
                ';
                break;
            default:
                return array();
        }

        $groupBy = ' GROUP BY h.horse_uid';
        $result = $this->getReadConnection()->query(
            $sql.$where.$groupBy,
            [
                'raceId' => $raceId,
                'horseIds' => $horseIds
            ]
        );
        $result = new ResultSet(null, new Row(), $result);
        $result = $result->toArrayWithRows();

        return $result;
    }
}
