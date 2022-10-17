<?php

declare(strict_types=1);

namespace Api\DataProvider\Bo\Bloodstock\Stallion;

use Api\Constants\Horses as Constants;
use Api\Input\Request;
use Api\DataProvider\HorsesDataProvider;
use Phalcon\Db\Sql\Builder;
use Api\Mvc\DataProvider\BuilderBasedTemporaryTable as TmpBuilder;
use Api\Input\Request\Horses\Bloodstock\Stallion\DamSireSeasons as DamSireSeasonsRequest;

/**
 * Class Stallion
 *
 * @package Api\DataProvider\Bo\Bloodstock\Stallion
 */
class Stallion extends HorsesDataProvider
{
    const TABLE_STALLION_COMMON_DATA = 'stallion_common_data';

    /**
     * Temporary table object
     *
     * @var TmpBuilder|null
     */
    private static $tmpTable = null;

    /**
     * @var Request
     */
    private $request;

    /**
     * Stallion constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return Request
     */
    protected function getRequest()
    {
        return $this->request;
    }

    /**
     * @return TmpBuilder
     */
    protected function createTemporaryTable()
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                h.horse_uid
                , h.style_name
                , h.horse_sex_code
                , h.horse_date_of_birth
                , country_origin_code = ltrim(rtrim(h.country_origin_code))
                , c.country_code
                , h.dam_uid
                , hr.final_race_outcome_uid
                , hr.rp_postmark
                , hr.rp_topspeed
                , hr.official_rating_ran_off
                , ri.race_instance_uid
                , ri.race_group_uid
                , ri.race_type_code
                , ri.race_datetime
                , ri.ages_allowed_uid
                , ri.race_instance_title
                , ri.distance_yard
                , ri.going_type_code
                , ri.no_of_runners
                , ri.course_uid
                , race_outcome_position = CASE
                    WHEN
                        hr.final_race_outcome_uid IN (51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 121)
                    THEN
                        0
                    ELSE
                        CASE
                            WHEN hr.final_race_outcome_uid > 70
                            THEN hr.final_race_outcome_uid - 70
                            ELSE hr.final_race_outcome_uid
                        END
                END
                , current_official_rating = (
                    SELECT
                    CASE
                        WHEN ri.race_type_code = " . Constants::RACE_TYPE_FLAT_TURF . " THEN rh.current_official_turf_rating
                        WHEN ri.race_type_code = " . Constants::RACE_TYPE_FLAT_AW . " THEN rh.current_official_aw_rating
                        ELSE CASE
                            WHEN rh.current_official_rating_chase > rh.current_official_rating_hurdle
                              OR rh.current_official_rating_hurdle IS NULL
                            THEN rh.current_official_rating_chase
                            ELSE rh.current_official_rating_hurdle
                        END
                    END
                    FROM racing_horse rh WHERE rh.horse_uid = hr.horse_uid
                )
            INTO
                " . TmpBuilder::TEMPLATE_FOR_TABLE_NAME . "
            FROM
                horse h
            INNER JOIN
                horse_race hr ON hr.horse_uid = h.horse_uid
            INNER JOIN
                race_instance ri ON ri.race_instance_uid = hr.race_instance_uid
            INNER JOIN course c ON c.course_uid = ri.course_uid
            INNER JOIN horse h_dam ON h_dam.horse_uid = h.dam_uid
            WHERE
                 /*{WHERE}*/
                AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
            ");

        // In dam-sire-seasons-available request we want to get all progeny of dam-sire
        // in all other request we want only the progeny of the sire
        if ($this->request instanceof DamSireSeasonsRequest) {
            $builder->where('h_dam.sire_uid = :horseId');
        } else {
            $builder->where('h.sire_uid = :horseId');
        }
        $builder->setParam('horseId', $this->getHorseId());

        return new TmpBuilder($builder, static::TABLE_STALLION_COMMON_DATA);
    }

    /**
     * @return TmpBuilder
     */
    public function getTmpTableStallionCommonData(): TmpBuilder
    {
        if (is_null(self::$tmpTable)) {
            self::$tmpTable = $this->createTemporaryTable();
        }

        return self::$tmpTable;
    }

    /**
     * We need this method due to children can override it to set own horseId(e.g stallionId it's a horseId as well)
     *
     * @return int
     */
    protected function getHorseId(): int
    {
        return $this->getRequest()->getStallionId();
    }

    /**
     * Clear static tmp table
     */
    public static function clear()
    {
        self::$tmpTable = null;
    }
}
