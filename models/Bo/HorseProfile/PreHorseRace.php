<?php

namespace Models\Bo\HorseProfile;

use Api\Constants\Horses as Constants;

/**
 * Class PreHorseRace
 *
 * @package Bo\HorseProfile
 */
class PreHorseRace extends \Models\PreHorseRace
{
    /**
     * @param $horseId
     *
     * @return array
     */
    public function getTips($horseId)
    {
        $sql = '
            SELECT
                phr.race_instance_uid,
                t.newspaper_uid,
                t.naps_style
            FROM
                pre_horse_race phr
            INNER JOIN tipster_selection ts ON ts.race_instance_uid = phr.race_instance_uid
            INNER JOIN rp_tipsters t ON t.tipster_uid = ts.tipster_uid
            WHERE
                phr.horse_uid = :horseUid
                AND ts.horse_uid = phr.horse_uid
            GROUP BY
                phr.race_instance_uid,
                t.newspaper_uid,
                t.naps_style
        ';

        $res = $this->getReadConnection()->query(
            $sql,
            ['horseUid' => $horseId]
        );

        $tips = (new \Phalcon\Mvc\Model\Resultset\General(null, new \Phalcon\Mvc\Model\Row\General(), $res))->toArrayWithRows();

        return empty($tips) ? null : $tips;
    }

    /**
     * @param $horseId
     *
     * @return array
     */
    public function getComments($horseId)
    {
        $sql = "
            SELECT
                phr.race_instance_uid,
                phrc.rp_current_spotlight individual_spotlight,
                phrg.varchar_255 individual_comment,
                phr.rp_owner_choice,
                ri.race_status_code
            FROM
                pre_horse_race phr
                INNER JOIN race_instance ri ON ri.race_instance_uid = phr.race_instance_uid
                    AND  phr.race_status_code =
                    (
                        CASE
                            WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                            THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                            ELSE ri.race_status_code
                        END
                    )
                INNER JOIN pre_horse_race_comments phrc ON phrc.race_instance_uid = phr.race_instance_uid
                                                            AND phrc.horse_uid = phr.horse_uid
                INNER JOIN pre_horse_race_genlkup phrg ON phrg.race_instance_uid = phr.race_instance_uid
                                                        AND phrg.horse_uid = phr.horse_uid
                INNER JOIN race_content_publish_time rcpt ON
                        rcpt.race_content_publish_race_uid = ri.race_instance_uid
                        AND rcpt.race_content_publish_time <= GETDATE()
                        AND rcpt.race_content_type_uid = 1
            WHERE
                ri.race_datetime > CONVERT(DATETIME, CONVERT(DATE, GETDATE()))
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND phr.horse_uid = :horseUid
                AND phrg.lookup_uid = 4";


        $res = $this->getReadConnection()->query(
            $sql,
            ['horseUid' => $horseId]
        );

        $comments = (new \Phalcon\Mvc\Model\Resultset\General(null, new \Phalcon\Mvc\Model\Row\General(), $res))->toArrayWithRows();

        return empty($comments) ? null : $comments;
    }
}
