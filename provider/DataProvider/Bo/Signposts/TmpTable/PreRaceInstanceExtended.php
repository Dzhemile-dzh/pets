<?php

namespace Api\DataProvider\Bo\Signposts\TmpTable;

use Api\DataProvider\Bo\TmpTable;
use Api\DataProvider\Factory\TmpSignpostsTables as Factory;
use Api\DataProvider\Bo\Signposts\TmpTable\WorkSignpostDataToday as WsdTable;
use Api\Constants\Horses as Constants;
use Api\Mvc\DataProvider\TemporaryTable;

/**
 * Class PreRaceInstanceExtended
 *
 * @package Api\DataProvider\Bo\Signposts\TmpTable
 */
class PreRaceInstanceExtended extends TemporaryTable
{
    const TABLE_ALIAS_PRE_RACE_INSTANCE = 'pri';
    const DATE_FORMAT = 'Y-m-d H:i:s';
    private $placeholders = [];

    /**
     * @return \Api\Input\Request\HorsesRequest
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param \Api\Input\Request\HorsesRequest $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @param string $tableName
     */
    protected function createTemporaryTable(string $tableName): void
    {
        $this->temoraryTableName = $tableName;
        $this->execute($this->getSql($tableName), $this->placeholders, true);
    }

    /**
     * @return string
     */
    protected function getSql(string $tableName)
    {
        return "
            SELECT
                h.horse_uid
                , horse_style_name = h.style_name
                , h.horse_name
                , horse_country_origin_code = h.country_origin_code
                , pri.race_instance_uid
                , pri.race_datetime
                , pri_no_of_runners = pri.no_of_runners 
                , ri.race_instance_title
                , ri.race_type_code
                , c.course_uid
                , course_country_code = c.country_code
                , course_style_name = c.style_name
                , c.course_name
                , c.rp_abbrev_4
                , phr.rp_postmark
                , phr.rp_owner_choice
                , phr.non_runner
                , phr.race_status_code
                , phr.saddle_cloth_no
                , ho.owner_uid
                , ho.owner_change_date
                , phr.jockey_uid
                , phr.horse_head_gear_uid
                , rg.race_group_desc
                , perform_race_uid_atr = {$this->getSqlPerformRaceUidAtr()}
                , perform_race_uid_ruk = {$this->getSqlPerformRaceUidRuk()}
                INTO {$tableName}
                FROM
                    pre_race_instance pri
                    JOIN pre_horse_race phr ON phr.race_instance_uid = pri.race_instance_uid
                    JOIN course c ON c.course_uid = pri.course_uid
                    JOIN horse h ON phr.horse_uid = h.horse_uid
                    JOIN horse_owner ho ON phr.horse_uid = ho.horse_uid
                    LEFT JOIN race_instance ri ON ri.race_instance_uid = pri.race_instance_uid
                    LEFT JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid
                    LEFT JOIN pre_race_instance_comments pric ON pric.race_instance_uid = pri.race_instance_uid
            " . $this
                ->resetRestrictions()
                ->setDirectRestrictions()
                ->setRequestRestrictions()
                ->getRestrictions() .
            "
            
            CREATE INDEX {$tableName}_race_datetime_idx ON {$tableName} (race_datetime)
            CREATE INDEX {$tableName}_jockey_idx ON {$tableName} (jockey_uid)
            CREATE INDEX {$tableName}_horse_idx ON {$tableName} (horse_uid)
            ";
    }

    /**
     * @return string
     */
    protected function getSqlPerformRaceUidAtr()
    {
        return "(SELECT MAX(perform_race_uid) FROM perform_race WHERE race_instance_uid = pri.race_instance_uid AND isATR = 1)";
    }

    /**
     * @return string
     */
    protected function getSqlPerformRaceUidRuk()
    {
        return "(SELECT MAX(perform_race_uid) FROM perform_race WHERE race_instance_uid = pri.race_instance_uid AND isATR IS NULL)";
    }

    /**
     * @return string
     */
    protected function getRestrictions()
    {
        return ' WHERE ' . implode(' AND ', $this->restrictions);
    }

    /**
     * @return $this
     */
    protected function resetRestrictions()
    {
        $this->restrictions = [];
        return $this;
    }

    /**
     * @return $this
     */
    protected function setDirectRestrictions()
    {
        list($start, $end) = $this->getDateBoundaries();
        $this->restrictions[] = "pri.race_datetime BETWEEN :restrictionDateStart AND :restrictionDateEnd";
        $this->placeholders['restrictionDateStart'] = $start;
        $this->placeholders['restrictionDateEnd'] = $end;

        $this->restrictions[] = "pri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT;
        $this->restrictions[] = "phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT;
        return $this;
    }

    /**
     * @return $this
     */
    protected function setRequestRestrictions()
    {
        if (!$this->getRequest()->isParameterSet('daily')) {
            $this->restrictions[] =
                "NOT EXISTS (
                    SELECT 1
                    FROM race_instance
                    WHERE race_instance_uid = " . static::TABLE_ALIAS_PRE_RACE_INSTANCE . ".race_instance_uid
                        AND race_status_code != " . Constants::RACE_STATUS_OVERNIGHT . "
                )";
        }

        if ($this->getRequest()->isParameterSet('raceId')) {
            $this->restrictions[] = static::TABLE_ALIAS_PRE_RACE_INSTANCE . '.race_instance_uid = '
                . $this->getRequest()->getRaceId();
        }

        if ($this->getRequest()->isParameterSet('courseId')) {
            $this->restrictions[] = 'c.course_uid = ' . $this->getRequest()->getCourseId();
        }
        return $this;
    }

    private function getDateBoundaries()
    {
        static $boundaries = null;
        if ($boundaries === null) {
            $sql = "
                SELECT 
                    date_start = MIN(race_datetime)
                    , date_end = MAX(race_datetime)
                FROM
                    {$this->getWorkSignpostsDataTodayTable()}
                WHERE
                    type IN (" . WsdTable::AHEAD_OF_HANDICAPPER . ", " . WsdTable::TRAVELLERS_CHECK . ")
            ";
            $dates = $this->query($sql)->getFirst();

            $startToday = new \DateTime(date('Y-m-d 00:00:00'));
            $endToday = new \DateTime(date('Y-m-d 23:59:59'));
            $boundaries = [$startToday->format(self::DATE_FORMAT), $endToday->format(self::DATE_FORMAT)];

            if (!empty($dates)) {
                $start = new \DateTime($dates->date_start);
                $end = new \DateTime($dates->date_end);

                $startDate = $start < $startToday ? $start : $startToday;
                $endDate = $end > $endToday ? $end : $endToday;
                $boundaries = [$startDate->format(self::DATE_FORMAT), $endDate->format(self::DATE_FORMAT)];
            }
        }
        return $boundaries;
    }

    private function getWorkSignpostsDataTodayTable()
    {
        return Factory::getWorkSignpostsDataToday();
    }


    /**
     * @var \Api\Input\Request\HorsesRequest
     */
    protected $request;

    /**
     * @var string[]
     */
    protected $restrictions;

    /**
     * @return string
     */
    protected function getTemporaryTableName(): string
    {
        return 'tmp_pre_race_instance_extended';
    }
}
