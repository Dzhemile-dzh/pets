<?php

namespace Api\DataProvider\Bo\OwnerGroups;

use Phalcon\Db\Sql\Builder;
use Api\DataProvider\HorsesDataProvider;
use Api\Input\Request\Horses\OwnerGroups\TrainerList as Request;
use Api\Constants\Horses as Constants;

/**
 * Class TrainerList
 *
 * @package Api\DataProvider\Bo\OwnerGroups
 */
class TrainerList extends HorsesDataProvider
{
    /**
     * @param Request $request
     *
     * @return array|null
     */
    public function getData(Request $request): ?array
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
            SELECT DISTINCT
                t.trainer_uid
                , trainer_name = t.style_name
                , trainer_country_code = t.country_code
                , trainer_country_desc = (SELECT c.country_desc FROM country c WHERE c.country_code = t.country_code)
                , owner_group_uid = /*{EXPRESSION(ownerGroup)}*/
                , ho.owner_uid
                , o.style_name as owner_name
            FROM
                horse_to_follow htf
                LEFT JOIN horse_trainer ht ON ht.horse_uid = htf.horse_uid
                    AND ISNULL(ht.trainer_change_date, :emptyDate) = :emptyDate
                LEFT JOIN trainer t ON t.trainer_uid = ht.trainer_uid
                LEFT JOIN horse_owner ho ON ho.horse_uid = htf.horse_uid 
                    AND ISNULL(ho.owner_change_date, :emptyDate) = :emptyDate
                LEFT JOIN owner o ON o.owner_uid = ho.owner_uid
            WHERE
                upper(t.style_name) != 'UNKNOWN'
                /*{WHERE}*/
            ORDER BY t.style_name
            PLAN '(use optgoal allrows_dss)'
        ");

        $builder->setParam('emptyDate', Constants::EMPTY_DATE);

        $condition = null;
        if ($request->isParameterProvided('ownerGroupId')) {
            if (array_key_exists($request->getOwnerGroupId(), Constants::COOLMORE_OWNER_GROUPS_TO_HORSE_IDS)) {
                $builder->expression('ownerGroup', (string)$request->getOwnerGroupId());
                $builder->where('htf.to_follow_uid = :horseToFollow');
                $builder->setParam('horseToFollow', Constants::COOLMORE_OWNER_GROUPS_TO_HORSE_IDS[$request->getOwnerGroupId()]);
            } else {
                $condition = '=';
            }
        } else {
            $condition = '<=';
        }
        if ($request->getOwnerGroupId() === 0) {
            $builder->expression(
                'ownerGroup',
                '(
                    SELECT rc.rabbah_uid
                    FROM rabbah_config rc
                    WHERE
                        rc.rabbah_uid BETWEEN 10 AND 99
                        AND htf.to_follow_uid = rc.to_follow_uid
                        AND ho.owner_uid = rc.owner_uid
                )'
            );
            $builder->where(
                'EXISTS (
                    SELECT 1
                    FROM rabbah_config rc
                    WHERE
                        rc.rabbah_uid BETWEEN 10 AND 99
                        AND htf.to_follow_uid = rc.to_follow_uid
                        AND ho.owner_uid = rc.owner_uid)'
            );
        } elseif ($condition) {
            $builder->expression(
                'ownerGroup',
                '(SELECT rc.rabbah_uid
                    FROM rabbah_config rc
                    WHERE
                        rc.rabbah_uid ' . $condition . ' :ownerGroupId
                        AND htf.to_follow_uid = rc.to_follow_uid
                        AND ho.owner_uid = rc.owner_uid)'
            );
            $builder->where(
                'EXISTS (
                    SELECT 1
                    FROM rabbah_config rc
                    WHERE
                        rc.rabbah_uid ' . $condition . ' :ownerGroupId
                        AND htf.to_follow_uid = rc.to_follow_uid
                        AND ho.owner_uid = rc.owner_uid)'
            );

            if ($request->isParameterProvided('ownerGroupId')) {
                $builder->setParam('ownerGroupId', $request->getOwnerGroupId());
            } else {
                $builder->setParam('ownerGroupId', Constants::STANDARD_OWNERS_ID);
            }
        }

        if ($request->isParameterProvided('ownerId')) {
            $builder->where('AND ho.owner_uid = :ownerId');
            $builder->setParam('ownerId', $request->getOwnerId());
        }

        if ($request->isParameterProvided('trainerCountryCode')) {
            $builder->where('AND t.country_code = :trainerCountryCode');
            $builder->setParam('trainerCountryCode', $request->getTrainerCountryCode());
        }

        $data = $this->queryBuilder($builder);

        return $data->getGroupedResult(
            [
                'trainer_uid',
                'trainer_name',
                'trainer_country_code',
                'trainer_country_desc',
                'trainer_owners' => [
                    'owner_uid',
                    'owner_name',
                    'owner_group_uid'
                ]
            ]
        );
    }
}
