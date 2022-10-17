<?php

namespace Api\DataProvider\Bo\OwnerGroups;

use Phalcon\Db\Sql\Builder;
use Api\DataProvider\HorsesDataProvider;
use Api\Input\Request\Horses\OwnerGroups\OwnerList as Request;
use Api\Constants\Horses as Constants;

/**
 * @package Api\DataProvider\Bo\OwnerGroups
 */
class OwnerList extends HorsesDataProvider
{
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
                owner_group_uid = rc.rabbah_uid
                , owner_group_lookup_uid = rc.rabbah_config_uid
                , rc.to_follow_uid
                , rc.owner_uid
                , owner_name = o.style_name
            FROM
                rabbah_config rc
                JOIN owner o ON o.owner_uid = rc.owner_uid
            WHERE
                rc.rabbah_config_uid <> 0
                /*{WHERE}*/
        ");

        if ($request->isParameterProvided('ownerGroupId')) {
            if (array_key_exists($request->getOwnerGroupId(), Constants::COOLMORE_OWNER_GROUPS_TO_HORSE_IDS)) {
                $builder->union([
                    $this->getOwners($builder, $request->getOwnerGroupId()),
                    $this->getCoolmoreOwners($builder, $request->getOwnerGroupId())
                ]);
            } else {
                $builder->where("rc.rabbah_uid = :ownerGroupId");
                $builder->setParam('ownerGroupId', $request->getOwnerGroupId());
            }
        } else {
            $builder->where("rc.rabbah_uid <= :standardOwnersId");
            $builder->setParam('standardOwnersId', Constants::STANDARD_OWNERS_ID);
        }

        $data = $this->queryBuilder($builder);

        return $data->toArrayWithRows();
    }

    /**
     * @param string $sql
     * @return Builder
     */
    private function getOwners(Builder $builderOrig, int $ownerGroupId): Builder
    {
        $builder = clone $builderOrig;

        $builder->where("rc.rabbah_uid = :ownerGroupId");
        $builder->setParam('ownerGroupId', $ownerGroupId);

        return $builder;
    }

    /**
     * @param Request $request
     * @return Builder
     */
    private function getCoolmoreOwners(Builder $builderOrig, int $ownerGroupUid): Builder
    {
        $builder = clone $builderOrig;

        $builder->setSqlTemplate(
            "
                SELECT
                    owner_group_uid = :ownerGroupId
                    , owner_group_lookup_uid = null
                    , htf.to_follow_uid
                    , o.owner_uid
                    , owner_name = o.style_name
                FROM
                    horse_to_follow htf
                    LEFT JOIN horse_owner ho ON ho.horse_uid = htf.horse_uid
                        AND ISNULL(ho.owner_change_date, :emptyDate) = :emptyDate
                    JOIN owner o ON o.owner_uid = ho.owner_uid
                WHERE
                    NOT EXISTS (
                        SELECT 1
                        FROM rabbah_config rc
                        WHERE
                            rc.rabbah_uid = :ownerGroupId
                            AND ho.owner_uid = rc.owner_uid
                        )
                    AND htf.to_follow_uid = :horseToFollow
            "
        );

        $builder
            ->setParam('emptyDate', Constants::EMPTY_DATE)
            ->setParam('ownerGroupId', $ownerGroupUid)
            ->setParam('horseToFollow', Constants::COOLMORE_OWNER_GROUPS_TO_HORSE_IDS[$ownerGroupUid]);

        return $builder;
    }
}
