<?php
namespace Api\DataProvider\Bo\Bloodstock\Stallion;

use Phalcon\Mvc\DataProvider;
use Api\Input\Request\HorsesRequest;

class FeeHistory extends DataProvider
{
    /**
     * @param HorsesRequest $request
     *
     * @return \Api\Row\Bloodstock\Stallion\FeeHistory|null
     */
    public function getFeeHistory(HorsesRequest $request)
    {
        $result = $this->query(
            "SELECT
                snf.nomination_fee
                , stud_fee_condition = LOWER(snf.stud_fee_condition)
                , stud.stud_name
                , stud.country_code
                , c.country_desc
                , cur.cur_code
                , snf.year
                , cc.exchange_rate
            FROM
                stallion_nomination_fees snf
            LEFT JOIN
                stud stud ON stud.stud_uid = snf.stud_uid
            LEFT JOIN
                currencies cur ON cur.cur_uid = snf.cur_uid
            LEFT JOIN
                country_currencies cc ON (cc.cur_uid = snf.cur_uid AND cc.year = snf.year)
            LEFT JOIN
                country c ON c.country_code = stud.country_code
            WHERE
                snf.horse_uid = :horseId:
                AND (
                    snf.nomination_fee > 0
                    OR (
                        UPPER(snf.stud_fee_condition) = 'PRIVATE'
                        OR UPPER(snf.stud_fee_condition) LIKE 'ON APPLICATION%'
                        OR UPPER(snf.stud_fee_condition) LIKE 'PRICE ON APPLICATION%'
                        OR UPPER(snf.stud_fee_condition) LIKE 'POA%'
                    )
                )
            ORDER BY
                snf.year DESC
            ",
            [
                'horseId' => $request->getStallionId(),
            ],
            new \Api\Row\Bloodstock\Stallion\FeeHistory()
        );

        return $result->toArrayWithRows() ? : null;
    }
}
