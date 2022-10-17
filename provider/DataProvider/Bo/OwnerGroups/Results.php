<?php

namespace Api\DataProvider\Bo\OwnerGroups;

use Api\Constants\Horses as Constants;
use Api\Input\Request\Horses\OwnerGroups\Results as Request;
use Phalcon\Db\Sql\Builder;
use Api\DataProvider\Traits\OwnerGroup as OwnerGroupTrait;

/**
 * @package Api\DataProvider\Bo\OwnerGroups
 */
class Results extends OwnerGroupsProvider
{
    use OwnerGroupTrait;
    /**
     * @param Request $request
     *
     * @return array|null
     */
    public function getData(Request $request): ?array
    {
        $builder = new Builder($request);

        $builder->setSqlTemplate("
            SELECT
                ri.race_instance_uid,
                ri.race_datetime,
                ri.race_instance_title,
                ri.distance_yard,
                ri.race_status_code,
                local_meeting_race_datetime = dateadd(MINUTE, isnull(clt.hours_difference, 0) * 60, ri.race_datetime),
                clt.hours_difference,
                c.course_uid,
                course_name = c.style_name,
                diffusion_course_name = c.course_name,
                c.country_code,
                hr.horse_uid,
                horse_name = h.style_name,
                horse_country_origin_code = h.country_origin_code,
                h.sire_uid,
                sire_name = s.style_name,
                sire_country = s.country_origin_code,
                h.dam_uid,
                dam_name = d.style_name,
                dam_country = d.country_origin_code,
                hr.trainer_uid,
                trainer_name = t.style_name,
                trainer_country_code = t.country_code,
                trainer_country_desc = tc.country_desc,
                hr.owner_uid,
                owner_name = o.style_name,
                hr.jockey_uid,
                jockey_name = j.style_name,
                hr.race_outcome_uid,
                hr.final_race_outcome_uid,
                ro.race_outcome_position,
                ro.race_outcome_code,
                ro.race_outcome_desc,
                ro.race_outcome_joint_yn,
                non_runner = CASE
                    WHEN hr.final_race_outcome_uid IN (" . Constants::NON_RUNNER_IDS . ")
                    THEN 'Y' ELSE 'N'
                END,
                ri.race_type_code,
                race_surface = rals.race_attrib_desc,
                rg.race_group_code,
                rg.race_group_desc,
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
                rv.stream_url,
                odds_uid = hr.starting_price_odds_uid,
                od.odds_desc,
                has_race_replay_video = null,
                black_type = 'N'
            FROM
                 /*{EXPRESSION(horseTables)}*/
                INNER JOIN horse_race hr ON hr.horse_uid = h.horse_uid
                INNER JOIN race_instance ri ON ri.race_instance_uid = hr.race_instance_uid
                 /*{EXPRESSION(sireHorseToFollow)}*/
                LEFT JOIN horse d ON d.horse_uid = h.dam_uid
                LEFT JOIN horse s ON s.horse_uid = h.sire_uid
                LEFT JOIN course c ON c.course_uid = ri.course_uid
                LEFT JOIN course_local_time clt ON clt.course_uid = ri.course_uid
                    AND ri.race_datetime BETWEEN clt.date_from AND clt.date_to
                LEFT JOIN owner o ON hr.owner_uid = o.owner_uid
                LEFT JOIN trainer t ON t.trainer_uid = hr.trainer_uid
                LEFT JOIN country tc ON t.country_code = tc.country_code
                LEFT JOIN jockey j ON j.jockey_uid = hr.jockey_uid
                LEFT JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
                LEFT JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid
                LEFT JOIN odds od ON od.odds_uid = hr.starting_price_odds_uid
                LEFT JOIN ruk_video rv ON rv.race_instance_uid = ri.race_instance_uid
                LEFT JOIN race_attrib_join rajs ON ri.race_instance_uid = rajs.race_instance_uid
                    AND rajs.race_attrib_uid IN (" . Constants::SURFACE_RACES_ATTRIBS . ")
                LEFT JOIN race_attrib_lookup rals ON rajs.race_attrib_uid = rals.race_attrib_uid
            WHERE
                ri.race_datetime BETWEEN :startDate AND :endDate
                AND (ri.race_type_code <> " . Constants::RACE_TYPE_P2P . ")
                /*{WHERE}*/
            ORDER BY ri.race_datetime
        ");

        // Here we build the rest of the SQL based on the request params.
        $this->configureBuilder($builder, $request, 'hr');

        if ($request->isOwnerIdProvided()) {
            $builder->where('AND hr.owner_uid = :ownerId');
        }

        if ($request->isTrainerIdProvided()) {
            $builder->where('AND hr.trainer_uid = :trainerId');
        }

        if ($request->isTrainerCountryCodeProvided()) {
            $builder->where('AND t.country_code = :trainerCountryCode');
        }
        if ($request->isCountryCodeProvided()) {
            $builder->where('AND c.country_code = :countryCode');
        }

        $builder
            ->setParam('startDate', $request->getStartDate() . ' 00:01')
            ->setParam('endDate', $request->getEndDate() . ' 23:59');

        $data = $this->queryBuilder($builder);

        return $data->getGroupedResult([
            'race_instance_uid',
            'race_datetime',
            'local_meeting_race_datetime',
            'hours_difference',
            'course_uid',
            'course_name',
            'diffusion_course_name',
            'country_code',
            'race_status_code',
            'distance_yard',
            'race_instance_title',
            'race_type_code',
            'race_surface',
            'race_group_code',
            'race_group_desc',
            'race_class',
            'has_race_replay_video',
            'stream_url',
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
                'odds_uid',
                'odds_desc',
                'owner_uid',
                'owner_name',
                'trainer_uid',
                'trainer_name',
                'trainer_country_code',
                'trainer_country_desc',
                'jockey_uid',
                'jockey_name',
                'race_outcome_uid',
                'final_race_outcome_uid',
                'race_outcome_position',
                'race_outcome_code',
                'race_outcome_desc',
                'race_outcome_joint_yn',
                'non_runner',
                'black_type',
            ],
        ]);
    }
}
