<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 2/26/2016
 * Time: 3:18 PM
 */

namespace Models\Bo\LookupTable;

class AdditionalCourseInfo extends \Models\AdditionalCourseInfo
{
    /**
     * @param string|null $straight_round_jubilee_code
     *
     * @return array
     */
    public function getAdditionalCourseInfoTable($straight_round_jubilee_code = null)
    {
        if (!empty($straight_round_jubilee_code)) {
            $sql = "
                SELECT
                    straight_round_jubilee_code,
                    straight_round_jubilee_desc,
                    rp_straight_round_jubilee_desc
                FROM straight_round_jubilee
                WHERE straight_round_jubilee_code = :code:
            ";

            $res = $this->getReadConnection()->query(
                $sql,
                [
                    'code' => strtoupper($straight_round_jubilee_code)
                ]
            );
        } else {
            $res = $this->getReadConnection()->query(
                'SELECT
                    straight_round_jubilee_code,
                    straight_round_jubilee_desc,
                    rp_straight_round_jubilee_desc
                FROM straight_round_jubilee'
            );
        }

        $result = new \Phalcon\Mvc\Model\Resultset\General(null, new \Phalcon\Mvc\Model\Row(), $res);

        return $result->toArrayWithRows('straight_round_jubilee_code');
    }
}
