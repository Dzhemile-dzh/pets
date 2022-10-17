<?php

namespace Models;

use Phalcon\Mvc\Model\Resultset\General as ResultSet;
use Phalcon\Mvc\Model\Row\General as Row;

class Season extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $season_uid;

    /**
     *
     * @var integer
     */
    protected $next_season_uid;

    /**
     *
     * @var integer
     */
    protected $previous_season_uid;

    /**
     *
     * @var string
     */
    protected $season_start_date;

    /**
     *
     * @var string
     */
    protected $season_end_date;

    /**
     *
     * @var string
     */
    protected $season_desc;

    /**
     *
     * @var string
     */
    protected $season_type_code;

    /**
     *
     * @var string
     */
    protected $current_season_yn;

    /**
     *
     * @var string
     */
    protected $timestamp;


    /**
     * @param string $seasonType
     *
     * @return string
     */
    public function getLastFifthSeasonStartDate($seasonType)
    {
        $sql = "
            SELECT TOP 5
                season_start_date
            FROM season
            WHERE
                season_type_code = :season_type_code:
                AND season_start_date < GETDATE()
            ORDER BY season_start_date DESC
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            ['season_type_code' => $seasonType]
        );

        $seasons = new ResultSet(null, new Row(), $res);

        $lastSeason = $seasons->getLast();

        return $lastSeason->season_start_date;
    }

    /**
     * Returns last Number of seasons by type
     * @param      $seasonTypeCode
     * @param null $number
     *
     * @return array
     */
    public function getLastNumberSeasons($seasonTypeCode, $number = null, $date = null)
    {
        $date = ($date != null) ? $date : date("Y-m-d H:i:s");
        $sql = "
            SELECT %s
                season_start_date
            FROM season
            WHERE
                season_type_code = :season_type_code
                AND season_start_date < :season_start_date
            ORDER BY season_start_date DESC
        ";
        $params = [
            'season_type_code' => $seasonTypeCode,
            'season_start_date' => $date
        ];
        if (is_null($number)) {
            $sql = sprintf($sql, '');
        } else {
            $sql = sprintf(
                $sql,
                'TOP '.(int)$number
            );
        }
        $res = $this->getReadConnection()->query(
            $sql,
            $params
        );

        $seasons = new ResultSet(null, new Row(), $res);

        return $seasons->toArrayWithRows();
    }

    /**
     * @param $seasonTypes
     * @param $seasonYearBegin
     * @param $seasonYearEnd
     *
     * @return array
     */
    public function getDefaultSeasons($seasonTypes, $seasonYearBegin = null, $seasonYearEnd = null)
    {

        $bindParams = ['seasonTypeCodes' => $seasonTypes];
        $restrictions[] = "season_type_code IN (:seasonTypeCodes:)";

        if (!empty($seasonYearBegin)) {
            $bindParams['seasonYearBegin'] = $seasonYearBegin;
            $restrictions[] = "YEAR(season_start_date) = :seasonYearBegin:";
            if (!empty($seasonYearEnd)) {
                $bindParams['seasonYearEnd'] = $seasonYearEnd;
                $restrictions[] = "YEAR(season_end_date) = :seasonYearEnd:";
            }
        } else {
            $restrictions[] = "current_season_yn = 'Y'";
        }

        $sql = "
            SELECT TOP 1
                season_type_code,
                season_start_date,
                season_end_date,
                season_desc
            FROM season
            WHERE
                " . implode(" AND ", $restrictions) . "
            ORDER BY
                season_end_date DESC
        ";

        $result = $this->getReadConnection()->query($sql, $bindParams);
        $result = new ResultSet(null, new Row(), $result);

        return $result->getFirst();
    }
}
