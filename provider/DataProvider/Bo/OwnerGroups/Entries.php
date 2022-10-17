<?php

namespace Api\DataProvider\Bo\OwnerGroups;

use Phalcon\Db\Sql\Builder;
use Api\Input\Request\Horses\OwnerGroups\Entries as Request;
use Api\Constants\Horses as Constants;
use Api\DataProvider\Traits\OwnerGroup as OwnerGroupTrait;
use Models\Bo\Selectors\Database as Database;

/**
 * Class Entries
 * @package Api\DataProvider\Bo\OwnerGroups
 */
class Entries extends OwnerGroupsProvider
{
    use OwnerGroupTrait;

    /**
     * @param Request $request
     *
     * @return array
     */
    public function getData(Request $request): array
    {
        $builder = new Builder();

        // This query bellow uses a foreign database so we need to get the dynamic name of it.
        $db = new Database();
        $metaTagsDbName = $db->getMetatagsDb();

        $ownerGroupId = $request->isParameterExists("ownerGroupId") ? $request->getOwnerGroupId() : 'null';

        $builder->setSqlTemplate("
            SELECT
                ri.race_instance_uid,
                ri.race_instance_title,
                ri.race_datetime,
                ri.distance_yard,
                ri.race_status_code,
                local_meeting_race_datetime = dateadd(MINUTE, isnull(clt.hours_difference, 0)  * 60, ri.race_datetime),
                clt.hours_difference,
                ri.race_type_code,
                race_surface = rals.race_attrib_desc,
                race_class = (
                    SELECT DISTINCT ral.race_attrib_desc
                    FROM race_attrib_join raj, race_attrib_lookup ral
                    WHERE ri.race_instance_uid = raj.race_instance_uid
                    AND raj.race_attrib_uid = ral.race_attrib_uid
                    AND ral.race_attrib_code = (
                        CASE WHEN c.country_code = 'GB'
                            THEN " . Constants::RACE_CLASS_SUB . "
                            ELSE " . Constants::RACE_CLASS . "
                        END
                    )
                ),
                ri.course_uid,
                CMS_element_contents,
                course_name = c.style_name,
                diffusion_course_name = c.course_name,
                rg.race_group_code,
                rg.race_group_desc,
                c.country_code,
                h.horse_uid,
                horse_name = h.style_name,
                horse_country_origin_code = h.country_origin_code,
                h.sire_uid,
                sire_name = s.style_name,
                sire_country = s.country_origin_code,
                 h.dam_uid,
                dam_name = d.style_name,
                dam_country = d.country_origin_code,
                t.trainer_uid,
                trainer_name = t.style_name,
                trainer_country_code = t.country_code,
                trainer_country_desc = ctr.country_desc,
                o.owner_uid,
                owner_name = o.style_name,
                j.jockey_uid,
                jockey_name = j.style_name,
                forecast_odds_desc = od.odds_desc,
                non_runner = CASE WHEN phr.non_runner = 'Y' THEN 'Y' ELSE 'N' END,
                black_type = 'N',
                -- we need to know which is the owner group there are some conditions based on this.
                -- the god_live_stream is only for owner group 5. Otherwise it shouldn't appear at all.
                -- Note: we could use LEFT JOIN to get this information but the records in rabbah_id
                -- are not unique. That's why we get it from the request params.
                owner_group_id = {$ownerGroupId}
            FROM
                /*{EXPRESSION(horseTables)}*/
                LEFT JOIN horse d ON d.horse_uid = h.dam_uid
                LEFT JOIN horse s ON s.horse_uid = h.sire_uid
                INNER JOIN pre_horse_race phr ON phr.horse_uid = h.horse_uid
                /*{EXPRESSION(sireHorseToFollow)}*/
                LEFT JOIN odds od ON od.odds_uid = phr.forecast_sp_uid
                INNER JOIN race_instance ri ON ri.race_instance_uid = phr.race_instance_uid
                INNER JOIN horse_owner ho ON ho.horse_uid = h.horse_uid
                    AND ISNULL(ho.owner_change_date, '" . Constants::EMPTY_DATE . "') = '" . Constants::EMPTY_DATE . "'
                INNER JOIN owner o ON ho.owner_uid = o.owner_uid
                LEFT JOIN course c ON c.course_uid = ri.course_uid
                LEFT JOIN course_local_time clt ON clt.course_uid = ri.course_uid
                    AND ri.race_datetime BETWEEN clt.date_from AND clt.date_to
                LEFT JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid
                LEFT JOIN horse_trainer ht ON ht.horse_uid = h.horse_uid
                    AND ISNULL(ht.trainer_change_date, '" . Constants::EMPTY_DATE . "') = '" . Constants::EMPTY_DATE . "'
                LEFT JOIN trainer t ON t.trainer_uid = ht.trainer_uid
                LEFT JOIN country ctr ON t.country_code = ctr.country_code
                LEFT JOIN jockey j ON j.jockey_uid = phr.jockey_uid
                LEFT JOIN race_attrib_join rajs ON ri.race_instance_uid = rajs.race_instance_uid
                    AND rajs.race_attrib_uid IN (" . Constants::SURFACE_RACES_ATTRIBS . ")
                LEFT JOIN race_attrib_lookup rals ON rajs.race_attrib_uid = rals.race_attrib_uid
                LEFT JOIN god_course_channel gcc ON gcc.course_uid = ri.course_uid
                LEFT JOIN {$metaTagsDbName}..CMS_element e ON e.CMS_display_ref = gcc.CMS_display_ref
                LEFT JOIN {$metaTagsDbName}..CMS_version v ON e.CMS_version_uid = v.CMS_version_uid
                    AND v.CMS_version_description='Godolphin v1'
                    AND v.CMS_version_preview_YN='N'
            WHERE
                CASE WHEN phr.race_status_code = " . Constants::RACE_STATUS_CALENDAR . "
                    THEN '7' ELSE
                        CASE WHEN phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                            THEN '0'
                            ELSE phr.race_status_code
                        END
                    END = (
                        SELECT MIN(
                            CASE WHEN iphr.race_status_code = " . Constants::RACE_STATUS_CALENDAR . "
                                THEN '7'
                                ELSE
                                    CASE WHEN iphr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                                        THEN '0'
                                        ELSE iphr.race_status_code
                                    END
                            END
                        )
                        FROM pre_horse_race iphr
                        WHERE iphr.race_instance_uid = phr.race_instance_uid
                        GROUP BY iphr.race_instance_uid
                    )
                AND ri.race_status_code IN (:raceStatus)
                AND(ri.race_type_code != 'P')
                /*{WHERE}*/
                ORDER BY
                    ri.race_datetime,
                    CASE WHEN od.odds_value IS NOT NULL
                        THEN od.odds_value
                        ELSE h.horse_uid
                    END
            PLAN '(use optgoal allrows_dss)'
        ");
        // Here we build the rest of the SQL based on the request params.
        $this->configureBuilder($builder, $request, 'ho');

        if ($request->isOwnerIdProvided()) {
            $builder->where('AND ho.owner_uid = :ownerId');
            $builder->setParam('ownerId', $request->getOwnerId());
        }

        if ($request->isTrainerIdProvided()) {
            $builder->where('AND ht.trainer_uid = :trainerId');
            $builder->setParam('trainerId', $request->getTrainerId());
        }

        if ($request->isCountryCodeProvided()) {
            $builder->where('AND c.country_code = :courseCountryCode');
            $builder->setParam('courseCountryCode', $request->getCountryCode());
        }

        if ($request->isTrainerCountryCodeProvided()) {
            $builder->where('AND t.country_code = :trainerCountryCode');
            $builder->setParam('trainerCountryCode', $request->getTrainerCountryCode());
        }

        if ($request->isDateRangeProvided()) {
            $builder->where('AND ri.race_datetime BETWEEN :startDate: AND :endDate:');

            $builder->setParam(
                'startDate',
                date("Y-m-d H:i:s", strtotime($request->getStartDate() . " 00:01:00"))
            );

            $builder->setParam(
                'endDate',
                date("Y-m-d H:i:s", strtotime($request->getEndDate() . " 23:59:59"))
            );
        }

        $raceStatuses = [
            Constants::getConstantValue(Constants::RACE_STATUS_OVERNIGHT),
            Constants::getConstantValue(Constants::RACE_STATUS_3DAYS, true),
            Constants::getConstantValue(Constants::RACE_STATUS_4DAYS, true),
            Constants::getConstantValue(Constants::RACE_STATUS_5DAYS, true),
            Constants::getConstantValue(Constants::RACE_STATUS_6DAYS, true)
        ];

        if ($request->isParameterExists('includeCalendarRaces') && $request->getIncludeCalendarRaces()) {
            $raceStatuses[] = Constants::getConstantValue(Constants::RACE_STATUS_CALENDAR);
        }

        $builder->setParam('raceStatus', $raceStatuses);

        $data = $this->queryBuilder($builder);

        return $data->getGroupedResult([
            'race_instance_uid',
            'race_datetime',
            'local_meeting_race_datetime',
            'hours_difference',
            'race_type_code',
            'race_surface',
            'race_class',
            'race_group_code',
            'race_group_desc',
            'course_uid',
            'course_name',
            'diffusion_course_name',
            'country_code',
            'CMS_element_contents',
            'race_status_code',
            'distance_yard',
            'race_instance_title',
            'owner_group_id',
            'runners' => [
                'horse_uid',
                'horse_name',
                'horse_country_origin_code',
                'sire_uid',
                'sire_name',
                'sire_country',
                'dam_uid',
                'dam_name',
                'dam_country',
                'owner_uid',
                'owner_name',
                'trainer_uid',
                'trainer_name',
                'trainer_country_code',
                'trainer_country_desc',
                'jockey_uid',
                'jockey_name',
                'forecast_odds_desc',
                'non_runner',
                'black_type'
            ]
        ]);
    }
}
