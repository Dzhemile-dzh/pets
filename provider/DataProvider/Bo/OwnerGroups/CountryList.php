<?php

namespace Api\DataProvider\Bo\OwnerGroups;

use Phalcon\Db\Sql\Builder;
use Api\DataProvider\HorsesDataProvider;
use Api\Constants\Horses as Constants;

/**
 * Class HorseList
 *
 * @package Api\DataProvider\Bo\OwnerGroups
 */
class CountryList extends HorsesDataProvider
{
    /**
     * @param int|null $ownerGroupId
     *
     * @return array
     */
    public function getData(?int $ownerGroupId): array
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT DISTINCT
                ctr.country_code,
                ctr.country_desc
            FROM
                course c
                INNER JOIN (
                    SELECT
                        ri.course_uid
                    FROM
                        horse_to_follow htf
                        INNER JOIN pre_horse_race phr ON phr.horse_uid = htf.horse_uid
                        INNER JOIN race_instance ri ON ri.race_instance_uid = phr.race_instance_uid
                    WHERE
                        /*{EXPRESSION(rc)}*/
                    GROUP BY ri.course_uid
                    UNION
                    SELECT
                        ri.course_uid
                    FROM
                        horse_to_follow htf
                        INNER JOIN horse_race hr ON hr.horse_uid = htf.horse_uid
                        INNER JOIN race_instance ri ON ri.race_instance_uid = hr.race_instance_uid
                    WHERE
                        /*{EXPRESSION(rc)}*/
                    GROUP BY ri.course_uid
                    ) t ON c.course_uid = t.course_uid
                    INNER JOIN country ctr ON ctr.country_code = c.country_code
            ORDER BY ctr.country_code
            PLAN '(use optgoal allrows_dss)'
        ");

        $condition = null;
        if ($ownerGroupId) {
            if (array_key_exists($ownerGroupId, Constants::COOLMORE_OWNER_GROUPS_TO_HORSE_IDS)) {
                $builder->expression('rc', 'htf.to_follow_uid = ' . Constants::COOLMORE_OWNER_GROUPS_TO_HORSE_IDS[$ownerGroupId]);
            }
            if ($ownerGroupId == Constants::COOLMORE_OWNER_GROUP_ID) {
                $builder->expression('rc', 'htf.to_follow_uid = ' . Constants::COOLMORE_HORSE_TO_FOLLOW_ID);
            } else {
                $condition = '=';
            }
        } else {
            $condition = '<=';
        }

        if ($condition) {
            $sql = 'EXISTS (
                    SELECT 1
                    FROM rabbah_config rc
                    WHERE
                        rc.rabbah_uid ' . $condition . (($ownerGroupId) ? $ownerGroupId : Constants::STANDARD_OWNERS_ID) . '
                        AND htf.to_follow_uid = rc.to_follow_uid
                )';

            $builder->expression('rc', $sql);
        }

        $data = $this->queryBuilder($builder);

        return $data->toArrayWithRows();
    }
}
