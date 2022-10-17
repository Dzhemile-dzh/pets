<?php
/**
 * Created by PhpStorm.
 * User: gpurnarov
 * Date: 20/02/19
 * Time: 16:07
 */

namespace Api\DataProvider\Traits;

use Api\Constants\Horses as Constants;
use Api\Input\Request\HorsesRequest;
use Phalcon\Db\Sql\Builder;

trait OwnerGroup
{
    /**
     * Based on the request params we configure sql template to show the requested data
     * This is applicable for entries and results
     * @param Builder $builder
     * @param HorsesRequest $request
     * @param String $horseOwnerTable | different endpoints uses different source to get owner uid
     * @return Builder
     */
    public function configureBuilder(Builder &$builder, HorsesRequest $request, string $horseOwnerTable)
    {
        $seasonSireGroupName = false;
        if ($request->isParameterExists('firstSeasonSireGroupName')) {
            $seasonSire = 'firstSeasonSire';
            $seasonSireGroupName = $request->getfirstSeasonSireGroupName();
            $seasonSireSql = 'firstSeasonSireIds';
            $northernToFollowId = Constants::FIRST_SEASON_NORTHERN_HEMISPHERE_FOLLOW_UID;
            $southernToFollowId = Constants::FIRST_SEASON_SOUTHERN_HEMISPHERE_FOLLOW_UID;
        } elseif ($request->isParameterExists('secondSeasonSireGroupName')) {
            $seasonSire = 'secondSeasonSire';
            $seasonSireGroupName = $request->getSecondSeasonSireGroupName();
            $seasonSireSql = 'secondSeasonSireIds';
            $northernToFollowId = Constants::SECOND_SEASON_NORTHERN_HEMISPHERE_FOLLOW_UID;
            $southernToFollowId = Constants::SECOND_SEASON_SOUTHERN_HEMISPHERE_FOLLOW_UID;
        }

        if ($seasonSireGroupName) {
            $builder->where(
                'shtf.to_follow_uid IN (:' . $seasonSireSql . ')'
            );

            // We don't need to check if the provided group name is existing because we validate it in the input
            $builder->setParam($seasonSireSql, Constants::IDS_OF_OWNER_GROUPS[$seasonSireGroupName][$seasonSire]);

            // we add this conditional statement to check that country code is from the right Hemisphere
            // based on to_follow_uid
            $builder->where(
                'shtf.to_follow_uid = CASE WHEN c.country_code IN (:northernCountryList) 
                THEN ' . $northernToFollowId . '
                WHEN c.country_code IN (:southernCountryList) 
                THEN ' . $southernToFollowId . '
                END'
            );

            $builder->setParam('southernCountryList', Constants::COUNTRY_GROUPS[$southernToFollowId]);
            $builder->setParam('northernCountryList', Constants::COUNTRY_GROUPS[$northernToFollowId]);

            // In case when we have to look for first/second season sire
            // we shouldn't have a restriction for horse to have a record in horse_to_follow
            $builder->expression(
                'horseTables',
                'horse h
                LEFT JOIN horse_to_follow htf ON h.horse_uid = htf.horse_uid'
            );
        } else {
            // In case when we have to look for owner-group
            // we should show only horses which has records in horse_to_follow table
            $builder->expression(
                'horseTables',
                'horse_to_follow htf
            INNER JOIN horse h ON h.horse_uid = htf.horse_uid'
            );


            if (array_key_exists($request->getOwnerGroupId(), Constants::COOLMORE_OWNER_GROUPS_TO_HORSE_IDS)) {
                $builder->where('htf.to_follow_uid = :horseToFollow');
                $builder->setParam('horseToFollow', Constants::COOLMORE_OWNER_GROUPS_TO_HORSE_IDS[$request->getOwnerGroupId()]);
            } elseif ($request->getOwnerGroupId() == 0) {
                $builder->where(
                    'AND EXISTS (
                        SELECT 1
                        FROM rabbah_config rc
                        WHERE
                            rc.rabbah_uid BETWEEN 10 AND 99
                            AND htf.to_follow_uid = rc.to_follow_uid
                            AND ' . $horseOwnerTable . '.owner_uid = rc.owner_uid
                    )'
                );
            } elseif ($request->getOwnerGroupId() == Constants::SKIP_OWNER_GROUP_ID_CHECK) {
                $builder->where(
                    'AND ri.race_datetime BETWEEN  dateadd(dd, -6, getdate()) AND dateadd(dd, 6, getdate()) '
                );
                $builder->where(
                    'AND c.country_code NOT IN (\'' . Constants::COUNTRY_IND . '\', \'' . Constants::COUNTRY_ARO . '\') '
                );
                $builder->expression(
                    'horseTables',
                    'horse h
                LEFT JOIN horse_to_follow htf ON h.horse_uid = htf.horse_uid'
                );
            } else {
                $builder->where(
                    'EXISTS (
                        SELECT 1
                        FROM rabbah_config rc
                        WHERE
                            rc.rabbah_uid = :ownerGroupId
                            AND htf.to_follow_uid = rc.to_follow_uid
                            AND ' . $horseOwnerTable . '.owner_uid = rc.owner_uid
                    )'
                );
                $builder->setParam('ownerGroupId', $request->getOwnerGroupId());
            }
        }

        // We shouldn't include always sire horse_to_follow table
        // because if we do it for horses with more than one record there
        // we will return duplicate result
        $builder->expression(
            'sireHorseToFollow',
            $seasonSireGroupName ?
                'LEFT JOIN horse_to_follow shtf ON h.sire_uid = shtf.horse_uid' : ''
        );
        return $builder;
    }
}
