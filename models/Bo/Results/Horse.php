<?php

namespace Models\Bo\Results;

use Models\Selectors;

use Phalcon\DI;
use Phalcon\Mvc\Model\Row;
use Phalcon\Mvc\Model\Resultset\General;
use Phalcon\Mvc\Model\Resultset\ResultsetException;

use Api\Constants\Horses as Constants;

/**
 * Class Horse
 *
 * @package Models\Bo\Results
 */
class Horse extends \Models\Horse
{
    /**
     * @param array $raceId
     *
     * @return array
     */
    public function getNonRunners(array $raceId): array
    {
        $selectors = DI::getDefault()->getService('selectors')->resolve();

        $ageSql = $selectors->getHorseAgeSQL(
            'h.horse_date_of_birth',
            'h.country_origin_code',
            'ri.race_datetime'
        );

        $sql = "
            SELECT
                ri.race_instance_uid,
                h.horse_uid,
                h.style_name horse_name,
                horse_country_origin_code = h.country_origin_code,
                horse_age = {$ageSql},
                sire_name = sire_horse.style_name,
                sire_country = sire_horse.country_origin_code,
                first_season_sire_id = NULL,
                rp_close_up_comment,
                hr.weight_carried_lbs,
                jockey_style_name = j.style_name,
                trainer_style_name = t.style_name,
                owner_group_uid = NULL
            FROM race_instance ri
                INNER JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
                INNER JOIN horse h ON h.horse_uid = hr.horse_uid
                INNER JOIN horse sire_horse ON sire_horse.horse_uid = h.sire_uid
                LEFT JOIN jockey j ON j.jockey_uid = hr.jockey_uid
                LEFT JOIN trainer t ON t.trainer_uid = hr.trainer_uid
                LEFT JOIN horse_race_comments hrc ON hrc.race_instance_uid = hr.race_instance_uid AND hrc.horse_uid = hr.horse_uid
            WHERE
                ri.race_instance_uid IN (:race_instance_uid)
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND hr.final_race_outcome_uid IN (" . Constants::NON_RUNNER_IDS . ")
            ORDER BY h.style_name";

        $res = $this->getReadConnection()->query(
            $sql,
            ['race_instance_uid' => $raceId]
        );

        $resultCollection = new General(null, new Row(), $res);

        return $resultCollection->toArrayWithRows('race_instance_uid', null, true);
    }
}
