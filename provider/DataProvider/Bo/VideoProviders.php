<?php

namespace Api\DataProvider\Bo;

use Api\DataProvider\HorsesDataProvider;

/**
 * Class VideoProviders
 *
 * @package Api\DataProvider\Bo
 */
class VideoProviders extends HorsesDataProvider
{
    const VIDEO_DATE_START = 'Jan 1 2009 00:01';

    const VIDEO_PROVIDER_RUK = 'RUK';
    const LOOKUP_ID_COMPLETE_RUK = 1;
    const LOOKUP_ID_FINISH_RUK = 2;

    const VIDEO_PROVIDER_ATR = 'ATR';
    const LOOKUP_ID_COMPLETE_ATR = 5;
    const LOOKUP_ID_FINISH_ATR = 6;

    /**
     * @param array $raceIDs
     *
     * @return array
     *
     * @codeCoverageIgnore
     */
    public function getDetails($raceIDs)
    {
        /*
         * Ensure that the tmp table #tmp_race_ids does not already exist
         */
        $this->execute(
            "IF OBJECT_ID('tempdb..#tmp_race_ids') IS NOT NULL DROP TABLE #tmp_race_ids"
        );

        $sql = "
                SELECT
                    race_instance_uid
                INTO #tmp_race_ids
                FROM
                    race_instance
                WHERE
                    race_instance_uid IN (:raceIds)
        ";

        $this->execute(
            $sql,
            [
                'raceIds' => $raceIDs,
            ],
            false
        );

        $sql = "
            SELECT
                ri.race_instance_uid,
                ptv_video_id = isnull( pr.perform_race_uid, rig.ptv_video_id),
                video_provider = isnull(rig.video_provider,
                    CASE WHEN isnull(pr.isATR, 0) = 1 THEN '" . static::VIDEO_PROVIDER_ATR . "'
                        ELSE CASE WHEN pr.perform_race_uid IS NOT NULL THEN  '" . static::VIDEO_PROVIDER_RUK . "' END
                    END),
                rv.stream_url,
                complete_race_uid,
                complete_race_start,
                complete_race_end,
                finish_race_uid,
                finish_race_start,
                finish_race_end
            FROM
                race_instance ri
                LEFT JOIN (
                    SELECT
                        rigl1.race_instance_uid,
                        ptv_video_id = rigl1.int_1,
                        video_provider =  '" . static::VIDEO_PROVIDER_RUK . "',

                        complete_race_uid = rigl1.int_1,
                        complete_race_start = rigl1.int_2,
                        complete_race_end = rigl1.int_3,

                        finish_race_uid = rigl2.int_1,
                        finish_race_start = rigl2.int_2,
                        finish_race_end = rigl2.int_3
                    FROM race_instance_genlkup rigl1
                        LEFT JOIN race_instance_genlkup rigl2 ON rigl2.race_instance_uid = rigl1.race_instance_uid
                            AND rigl2.lookup_uid = " . static::LOOKUP_ID_FINISH_RUK . "
                    WHERE rigl1.race_instance_uid IN (select race_instance_uid from #tmp_race_ids)
                        AND rigl1.lookup_uid = " . static::LOOKUP_ID_COMPLETE_RUK . "
                    UNION
                    SELECT
                        rigl1.race_instance_uid,
                        ptv_video_id = rigl1.int_1,
                        video_provider =  '" . static::VIDEO_PROVIDER_ATR . "',

                        complete_race_uid = rigl1.int_1,
                        complete_race_start = rigl1.int_2,
                        complete_race_end = rigl1.int_3,

                        finish_race_uid = rigl2.int_1,
                        finish_race_start = rigl2.int_2,
                        finish_race_end = rigl2.int_3
                    FROM race_instance_genlkup rigl1
                        LEFT JOIN race_instance_genlkup rigl2 ON rigl2.race_instance_uid = rigl1.race_instance_uid
                            AND rigl2.lookup_uid = " . static::LOOKUP_ID_FINISH_ATR . "
                    WHERE rigl1.race_instance_uid IN (select race_instance_uid from #tmp_race_ids)
                        AND rigl1.lookup_uid = " . static::LOOKUP_ID_COMPLETE_ATR . "
                    ) rig ON rig.race_instance_uid = ri.race_instance_uid
                LEFT JOIN (
                    SELECT
                        race_instance_uid
                        , isATR
                        , perform_race_uid = MAX(perform_race_uid)
                    FROM perform_race
                    WHERE race_instance_uid IN (select race_instance_uid from #tmp_race_ids)
                    GROUP BY
                        race_instance_uid
                        , isATR
                    ) pr ON pr.race_instance_uid = ri.race_instance_uid
                LEFT JOIN ruk_video rv ON rv.race_instance_uid = ri.race_instance_uid
            WHERE ri.race_instance_uid IN (select race_instance_uid from #tmp_race_ids)
                AND ri.race_datetime > CONVERT(datetime, '" . static::VIDEO_DATE_START . "')
                AND (isnull(rig.video_provider,
                    CASE WHEN isnull(pr.isATR, 0) = 1
                        THEN '" . static::VIDEO_PROVIDER_ATR . "'
                        ELSE
                            CASE WHEN pr.perform_race_uid IS NOT NULL
                            --- There are french races that contain videos inside rv.stream_url
                            --- but those WHERE clauses here produce FALSE result so those
                            --- races in the end result are shown as without any video details.
                            OR rv.stream_url IS NOT NULL
                            THEN  '" . static::VIDEO_PROVIDER_RUK . "'
                        END
                    END)) IS NOT NULL
        ";

        $rows = $this->query(
            $sql,
            null,
            null,
            false
        );

        $rows = $rows->toArrayWithRows('race_instance_uid', null, true);

        /*
         * As a last step, drop the tmp table #tmp_race_ids
         */
        $this->execute(
            "IF OBJECT_ID('tempdb..#tmp_race_ids') IS NOT NULL DROP TABLE #tmp_race_ids"
        );

        return $rows;
    }
}
