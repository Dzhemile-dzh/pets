<?php

namespace Api\DataProvider\Bo\OwnerGroups;

use Phalcon\Db\Sql\Builder;
use Api\DataProvider\HorsesDataProvider;
use Api\Input\Request\Horses\OwnerGroups\Splash as Request;

/**
 * @package Api\DataProvider\Bo\OwnerGroups
 */
class Splash extends HorsesDataProvider
{
    /**
     * @param Request $request
     *
     * @return array|null
     */
    public function getData(Request $request): ?array
    {
        $builder = new Builder();
        $builder->setSqlTemplate(
            "
            SELECT DISTINCT
                rs.rabbah_config_uid owner_group_lookup_uid,
                rc.rabbah_uid owner_group_uid,
                rs.rabbah_splash_uid owner_group_splash_uid,
                rc.to_follow_uid,
                rs.device_type,
                rs.splash_url
            FROM
                rabbah_splash rs
            INNER JOIN rabbah_config rc 
                ON rs.rabbah_config_uid = rc.rabbah_config_uid
            WHERE 
                /*{WHERE}*/
            "
        );

        $isParametrized = false;

        if ($request->isParameterProvided('ownerGroupId')) {
            $builder->where("rc.rabbah_uid = :ownerGroupId");
            $builder->setParam('ownerGroupId', $request->getOwnerGroupId());
            $isParametrized = true;
        }

        if ($request->isParameterProvided('ownerGroupLookupId')) {
            $builder->where("rs.rabbah_config_uid = :ownerGroupLookupId");
            $builder->setParam('ownerGroupLookupId', $request->getOwnerGroupLookupId());
            $isParametrized = true;
        }

        if ($request->isParameterProvided('deviceType')) {
            $builder->where("rs.device_type = :deviceType");
            $builder->setParam('deviceType', trim($request->getDeviceType()));
            $isParametrized = true;
        }

        if (!$isParametrized) {
            $builder->where("rc.rabbah_uid <= 100");
        }

        $res = $this->queryBuilder($builder);

        $rtn =  $res->toArrayWithRows("owner_group_splash_uid");
        return $rtn;
    }
}
