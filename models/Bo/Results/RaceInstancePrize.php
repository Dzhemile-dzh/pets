<?php

namespace Models\Bo\Results;

use \Api\Constants\Horses as Constants;

/**
 * Class RaceInstancePrize
 *
 * @package Models\Bo\Results
 */
class RaceInstancePrize extends \Models\RaceInstancePrize
{
    /**
     * @param int    $raceId
     * @param string $raceDateTime
     *
     * @return array
     */
    public function getRacePrizes($raceId, $raceDateTime)
    {
        $sql = "
            SELECT
                rip.prize_sterling,
                rip.prize_euro,
                rip.position_no,
                rip.prize_euro_gross,
                prize_usd = ROUND(rip.prize_sterling * (
                    SELECT
                        MIN(cc.exchange_rate)
                    FROM country_currencies cc
                    WHERE
                        cc.year = YEAR(:raceDate)
                        AND cc.cur_uid = " . Constants::CURRENCY_USD_ID . "
                    ), 2)
            FROM race_instance_prize rip
            WHERE rip.race_instance_uid = :race_instance_uid
            ORDER BY rip.position_no";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'race_instance_uid' => $raceId,
                'raceDate' => $raceDateTime
            ]
        );

        $prizes = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return $prizes->toArrayWithRows();
    }
}
