<?php

namespace Api\DataProvider\Bo\OwnerGroups;

use Models\Selectors;
use Phalcon\Db\Sql\Builder;
use Api\DataProvider\HorsesDataProvider;
use Api\Input\Request\Horses\OwnerGroups\HorseList as Request;
use Api\Constants\Horses as Constants;

/**
 * Class HorseList
 *
 * @package Api\DataProvider\Bo\OwnerGroups
 */
class HorseList extends OwnerGroupsProvider
{
    /**
     * @param Request $request
     *
     * @return array|null
     */
    public function getData(Request $request): ?array
    {
        $selectors = new Selectors();

        $ageSql = $selectors->getHorseAgeSQL(
            'h.horse_date_of_birth',
            'h.country_origin_code'
        );

        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                h.horse_uid,
                horse_name = h.style_name,
                age = {$ageSql},
                horse_country_origin_code = h.country_origin_code,
                t.trainer_uid,
                trainer_name = t.style_name,
                trainer_country_code = t.country_code,
                trainer_country_desc = c.country_desc,
                o.owner_uid,
                owner_name = o.style_name,
                black_type = 'N'
            FROM
                horse_to_follow htf
                INNER JOIN horse h ON h.horse_uid = htf.horse_uid
                INNER JOIN horse_owner ho ON ho.horse_uid = h.horse_uid 
                    AND ISNULL(ho.owner_change_date, :emptyDate) = :emptyDate
                INNER JOIN owner o ON ho.owner_uid = o.owner_uid
                LEFT JOIN horse_trainer ht ON ht.horse_uid = h.horse_uid
                    AND ISNULL(ht.trainer_change_date, :emptyDate) = :emptyDate
                LEFT JOIN trainer t ON t.trainer_uid = ht.trainer_uid
                LEFT JOIN country c ON t.country_code = c.country_code
            WHERE
                LEFT(h.style_name, 1) != '0'
               /*{WHERE}*/
           ORDER BY h.style_name
           PLAN '(use optgoal allrows_dss)'
        ");

        $builder->setParam('emptyDate', Constants::EMPTY_DATE);

        $requestOwnerGroupId = $request->getOwnerGroupId();
        // we check to see if the request owner group id is in our coolmore owner group array
        if (in_array($requestOwnerGroupId, array_keys(CONSTANTS::COOLMORE_OWNER_GROUPS_TO_HORSE_IDS))) {
            $builder->where('htf.to_follow_uid = (:horseToFollowId)');
            // we check the corresponding coolmore owner group uid in accordance to to_follow_uid and set it in the SQL
            $builder->setParam('horseToFollowId', CONSTANTS::COOLMORE_OWNER_GROUPS_TO_HORSE_IDS[$requestOwnerGroupId]);
        } elseif ($request->getOwnerGroupId() == 0) {
            $builder->where(
                'AND EXISTS (
                    SELECT 1
                    FROM rabbah_config rc
                    WHERE
                        rc.rabbah_uid BETWEEN 10 AND 99
                        AND htf.to_follow_uid = rc.to_follow_uid
                        AND ho.owner_uid = rc.owner_uid
                )'
            );
        } else {
            $builder->where(
                'EXISTS (
                    SELECT 1
                    FROM rabbah_config rc
                    WHERE
                        rc.rabbah_uid = :ownerGroupId
                        AND htf.to_follow_uid = rc.to_follow_uid
                        AND ho.owner_uid = rc.owner_uid
                )'
            );
            $builder->setParam('ownerGroupId', $request->getOwnerGroupId());
        }

        if ($request->isOwnerIdProvided()) {
            $builder->where('AND ho.owner_uid = :ownerId');
            $builder->setParam('ownerId', $request->getOwnerId());
        }

        if ($request->isTrainerIdProvided()) {
            $builder->where('AND ht.trainer_uid = :trainerId');
            $builder->setParam('trainerId', $request->getTrainerId());
        }

        if ($request->isTrainerCountryCodeProvided()) {
            $builder->where('AND t.country_code = :trainerCountryCode');
            $builder->setParam('trainerCountryCode', $request->getTrainerCountryCode());
        }

        $data = $this->queryBuilder($builder);

        return $data->toArrayWithRows();
    }
}
