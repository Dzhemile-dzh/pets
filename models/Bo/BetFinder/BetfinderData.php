<?php

namespace Models\Bo\BetFinder;

use Phalcon\DI;
use Phalcon\Db\Column;
use Api\Row\BetFinder\BetFinder as Row;
use Phalcon\Mvc\Model\Resultset\ResultsetException;
use Phalcon\Mvc\Model\Resultset\General as ResultSet;
use \Api\Constants\Horses as Constants;

/**
 * Class BetfinderData
 *
 * @package Models\Bo\BetFinder
 */
class BetfinderData extends \Models\BetfinderData
{
    /**
     * @param bool $today
     *
     * @return array|null
     * @throws ResultsetException
     */
    public function getBetFinderFullData($today = false)
    {
        $params = [];
        $sql = "
            SELECT
                phr.weight_allowance_lbs,
                bf.owner_choice as rp_owner_choice,
                h.country_origin_code as horse_country_origin_code,
                sire.style_name sire_horse_name,
                sire.country_origin_code as sire_country_origin_code,
                bf.*
            FROM
                {$this->getWorkHorseDb()}..betfinder_data bf
            INNER JOIN
                pre_horse_race phr ON (
                        phr.race_instance_uid = bf.race_uid
                        AND phr.horse_uid = bf.horse_uid
                        AND phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                    )
            LEFT JOIN
                horse h ON bf.horse_uid = h.horse_uid
            LEFT JOIN
                horse sire ON h.sire_uid = sire.horse_uid
            WHERE
                bf.deleted = 0
                AND NOT EXISTS (
                    SELECT 1
                    FROM race_instance ri
                    WHERE ri.race_instance_uid = bf.race_uid
                        AND ri.race_status_code IN (" . Constants::RACE_STATUS_RESULTS . " , "
            . Constants::RACE_STATUS_ABANDONED . ")
                )
                AND NOT EXISTS (
                    SELECT 1
                    FROM pre_race_instance pri
                    WHERE pri.race_instance_uid = bf.race_uid
                    AND pri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                )
        ";

        if ($today) {
            $sql .= ' AND bf.race_datetime BETWEEN :dateFrom: AND :dateTo:';
            $currentDate = date('Y-m-d');
            $params = array_merge($params, [
                'dateFrom' => $currentDate . ' 00:00:00',
                'dateTo' => $currentDate . ' 23:59:59',
            ]);
        }

        $res = $this->getReadConnection()->query($sql, $params);
        $result = new ResultSet(null, new Row(), $res);

        $data = null;
        if (!empty($result->count())) {
            $data = [
                'bets' => $result->toArrayWithRows(),
                'version' => $this->getMaxVersion('fullData'),
            ];
        }

        return $data;
    }

    /**
     * @param int $version
     *
     * @return array|null
     * @throws ResultsetException
     */
    public function getBetFinderDiffData($version)
    {
        $res = $this->getReadConnection()->query(
            "SELECT
                phr.weight_allowance_lbs,
                bf.owner_choice as rp_owner_choice,
                h.country_origin_code as horse_country_origin_code,
                sire.style_name sire_horse_name,
                sire.country_origin_code as sire_country_origin_code,
                bf.*
            FROM {$this->getWorkHorseDb()}..betfinder_data bf
                LEFT JOIN pre_horse_race phr ON (
                        phr.race_instance_uid = bf.race_uid
                        AND phr.horse_uid = bf.horse_uid
                        AND phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                    )
                LEFT JOIN horse h ON bf.horse_uid = h.horse_uid
                LEFT JOIN horse sire ON h.sire_uid = sire.horse_uid
            WHERE bf.version > :version
            AND race_datetime > DATEADD(DAY, -2, GETDATE())",
            ['version' => $version],
            ['version' => Column::BIND_SKIP],
            false
        );

        $result = new ResultSet(null, new Row(), $res);

        if (empty($result->count())) {
            return null;
        }

        $data = [];
        $data['bets'] = $result->toArrayWithRows();
        $data['version'] = $this->getMaxVersion('diffData', ['version' => $version]);

        return $data;
    }

    /**
     * @return string DB name for work's horse
     */
    private function getWorkHorseDb()
    {
        return DI::getDefault()->getShared('selectors')->getDb()->getWorkHorseDb();
    }

    /**
     * @param string $for (fullData|diffData)
     * @param array  $params
     *
     * @return mixed
     * @throws ResultsetException
     */
    private function getMaxVersion($for, array $params = [])
    {
        $sql = "SELECT max_version = MAX(version) FROM {$this->getWorkHorseDb()}..betfinder_data";
        switch ($for) {
            case 'fullData':
                $sql .= " WHERE deleted = 0";
                $cursor = $this->getReadConnection()->query($sql);
                break;
            case 'diffData':
                $sql .= " WHERE version >= :version";
                $cursor = $this->getReadConnection()->query(
                    $sql,
                    ['version' => $params['version']],
                    ['version' => Column::BIND_SKIP],
                    false
                );
                break;
            default:
                throw new \InvalidArgumentException('You have to specify first parameter "for"');
        }

        $result = (new ResultSet(null, new Row(), $cursor))->getFirst();
        $result->max_version = bin2hex($result->max_version);

        return $result;
    }
}
