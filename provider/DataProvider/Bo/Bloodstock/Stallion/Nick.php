<?php

namespace Api\DataProvider\Bo\Bloodstock\Stallion;

use Phalcon\Db\Sql\Builder;

/**
 * Class Nick
 *
 * @package Api\DataProvider\Bo\Bloodstock\Stallion
 */
class Nick extends Stallion
{
    /**
     * @return \Phalcon\Mvc\Model\Row[]
     * @throws \Exception
     */
    public function getNick()
    {
        $builder = new Builder();
        $builder->setSqlTemplate(" 
            SELECT
                ancestor_uid = hs.horse_uid
                , ancestor_name = hs.style_name
                , ancestor_country_origin_code = hs.country_origin_code
                , tmp.horse_uid
                , tmp.style_name style_name
                , tmp.race_outcome_position
                , no_of_runners = COUNT(*)
                , win_prize_money = SUM(rip.prize_sterling)
            FROM
                /*{EXPRESSION(tmpTableStallionCommonData)}*/ tmp
            JOIN
                horse hd ON hd.horse_uid = tmp.dam_uid
            JOIN
                horse hs ON hs.horse_uid = hd.sire_uid
            JOIN
                course c ON c.course_uid = tmp.course_uid AND c.country_code IN ('GB', 'IRE')
            LEFT JOIN
                race_instance_prize rip ON rip.race_instance_uid = tmp.race_instance_uid
                    AND rip.position_no = tmp.race_outcome_position
            GROUP BY
                hs.horse_uid
                , hs.style_name
                , tmp.horse_uid
                , tmp.style_name
                , hs.country_origin_code
                , tmp.race_outcome_position
            ORDER BY
                hs.horse_uid,
                tmp.horse_uid
            ");
        $builder->expression(
            "tmpTableStallionCommonData",
            $this->getTmpTableStallionCommonData()->getTemporaryTable()
        );
        $result = $this->queryBuilder($builder);

        return $result->toArrayWithRows() ?: null;
    }
}
