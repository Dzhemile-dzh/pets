<?php
namespace Api\DataProvider\Bo\Bloodstock\Stallion;

use Api\Constants\Horses as Constants;
use Phalcon\Mvc\DataProvider;
use Api\Input\Request\HorsesRequest;
use Api\Exception\ValidationError;

class NickDescendants extends DataProvider
{
    /**
     * @param \Api\Input\Request\HorsesRequest $request
     *
     * @return \Api\Row\Bloodstock\Stallion\Nick[]
     *
     * @throws \Exception
     */
    public function getNickDescendants(HorsesRequest $request)
    {
        $bridge = [
            'a-z' => 'style_name ASC, total_money DESC',
            'wins' => 'wins DESC, win_prize_money DESC, total_money DESC',
            'win-prize' => 'win_prize_money DESC, total_money DESC',
            'total-prize' => 'total_money DESC',
        ];

        if (\Api\Input\Request\Horses\Bloodstock\Stallion\NickDescendants::getAvailableSortOrders() != array_keys($bridge)) {
            throw new ValidationError(12103);
        }

        $result = $this->query(
            "SELECT
                h.horse_uid
                , style_name = h.style_name
                , h.country_origin_code
                , runs = COUNT(*)
                , wins = SUM(CASE WHEN ro.race_outcome_position = 1 THEN 1 ELSE 0 END)
                , win_prize_money = SUM(CASE WHEN ro.race_outcome_position = 1 THEN rip.prize_sterling ELSE NULL END)
                , total_money = SUM(rip.prize_sterling)
            FROM
                horse h
            JOIN
                horse hd ON hd.horse_uid = h.dam_uid
            JOIN
                horse hs ON hs.horse_uid = hd.sire_uid
            JOIN
                horse_race hr ON hr.horse_uid = h.horse_uid
            JOIN
                race_instance ri ON ri.race_instance_uid = hr.race_instance_uid
                    AND ri.race_type_code <> " . Constants::RACE_TYPE_P2P . "
                    AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
            JOIN
                course c ON c.course_uid = ri.course_uid AND c.country_code IN ('GB', 'IRE')
            JOIN
                race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
                    AND ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
            LEFT JOIN
                race_instance_prize rip ON rip.race_instance_uid = hr.race_instance_uid
                AND rip.position_no = ro.race_outcome_position
            WHERE
                h.sire_uid = :horseUid:
                AND hs.horse_uid = :ancestorUid:
            GROUP BY
                h.horse_uid
                , h.style_name
            ORDER BY
                {$bridge[$request->getOrder()]}
            ",
            [
                'horseUid' => $request->getStallionId(),
                'ancestorUid' => $request->getStallionAncestorId()
            ],
            new \Api\Row\Bloodstock\Stallion\Nick()
        );

        return $result->toArrayWithRows();
    }
}
