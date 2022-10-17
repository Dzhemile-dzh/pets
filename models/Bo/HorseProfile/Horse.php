<?php

namespace Models\Bo\HorseProfile;

use Api\Constants\Horses as Constants;
use \Phalcon\Mvc\Model\Resultset\ResultsetException;
use \Phalcon\Mvc\ModelInterface;

/**
 * Class Horse
 *
 * @package Models\Bo\HorseProfile
 */
class Horse extends \Models\Horse
{
    const SALE_TYPE_FIRST = 'F';
    const SALE_TYPE_YEAR = 'Y';
    const SALE_TYPE_BREATH_UP = 'B';

    /**
     * @param int $horseId
     *
     * @return ModelInterface
     * @throws ResultsetException
     */
    public function getHorseDataForProfileInIndex($horseId)
    {
        $result = $this->getReadConnection()->query(
            "SELECT
                h.horse_date_of_birth,
                h.horse_date_of_death,
                h.country_origin_code,
                h.style_name,
                h.horse_colour_code,
                h.horse_sex_code,
                h.date_gelded,
                o.style_name AS owner_name,
                o.owner_uid,
                t.style_name AS trainer_name,
                t.trainer_uid,
                b.style_name AS breeder_name,
                h.horse_uid
            FROM horse h
            LEFT JOIN horse_owner ho ON ho.horse_uid = h.horse_uid
              AND isnull(ho.owner_change_date, '1900-01-01 00:00:00.0') = '1900-01-01 00:00:00.0'
            LEFT JOIN owner o ON o.owner_uid = ho.owner_uid
            LEFT JOIN horse_trainer ht ON ht.horse_uid = h.horse_uid
              AND  isnull(ht.trainer_change_date,  '1900-01-01 00:00:00.0') = '1900-01-01 00:00:00.0'
            LEFT JOIN trainer t ON t.trainer_uid = ht.trainer_uid
            LEFT JOIN breeder b ON b.breeder_uid = h.breeder_uid
            LEFT JOIN total_earnings_all_sires teas ON teas.total_uid = 1
            LEFT JOIN weatherbys_stallions ws ON ws.sire_uid = h.horse_uid AND ws.year = year(getDate())
            WHERE
                h.horse_uid = :horseUid
            ",
            [
                'horseUid' => $horseId,
            ]
        );

        return (new \Phalcon\Mvc\Model\Resultset\General(null, new \Api\Row\Horse(), $result))->getFirst();
    }

    /**
     * @param int $horseId
     *
     * @return \Api\Row\Horse
     */
    public function getHorseDataForProfile($horseId)
    {
        $result = $this->getReadConnection()->query(
            "SELECT
                h.horse_date_of_birth,
                h.horse_date_of_death,
                h.country_origin_code,
                h.sire_uid,
                h.dam_uid,
                h.style_name,
                h.horse_colour_code,
                h.horse_sex_code,
                h.date_gelded,
                hs.style_name AS sire_horse_name,
                hs.country_origin_code AS sire_country_origin_code,
                hd.style_name AS dam_horse_name,
                hd.country_origin_code AS dam_country_origin_code,
                hds.style_name AS dam_sire_horse_name,
                hss.horse_uid AS sires_sire_uid,
                hss.style_name AS sires_sire_name,
                sh.avg_flat_win_dist_of_progeny AS avg_flat_win_dist,
                ss.avg_flat_win_dist_of_progeny AS sire_avg_flat_win_dist,
                sd.avg_flat_win_dist_of_progeny AS dam_sire_avg_flat_win_dist,
                o.style_name AS owner_name,
                o.search_name AS owner_search_name,
                o.ptp_type_code AS owner_ptp_type_code,
                o.owner_uid,
                t.style_name AS trainer_name,
                t.trainer_uid,
                t.trainer_location,
                t.mirror_name AS trainer_search_name,
                t.ptp_type_code AS trainer_ptp_type_code,
                b.style_name AS breeder_name,
                h.horse_uid,
                hds.country_origin_code AS dam_sire_country_origin_code,
                CASE WHEN h.horse_sex_code IN ('" . Constants::HORSE_SEX_CODE_HORSE . "','"
            . Constants::HORSE_SEX_CODE_COLT . "','" . Constants::HORSE_SEX_CODE_GELDING . "','"
            . Constants::HORSE_SEX_CODE_RIG . "')
                THEN 0
                ELSE
                    CASE WHEN EXISTS(SELECT 1 FROM horse WHERE horse.dam_uid = h.horse_uid) OR EXISTS(SELECT 1 FROM bloodstock_sale WHERE dam_uid = h.horse_uid)
                    THEN 1
                    END
                END dam_status,
                hds.horse_uid AS dam_sire_uid,
                sire_status = (SELECT
                    CASE WHEN SUM(tmp.sire_status) > 0 THEN 1 ELSE 0 END
                FROM
                    (SELECT
                        sire_status = ISNULL(snf.nomination_fee,0) +
                            CASE WHEN ISNULL(snf.stud_fee_condition,'') = '' THEN 0 ELSE 1 END
                    FROM
                        stallion_nomination_fees snf
                    WHERE
                        snf.horse_uid = :horseUid:
                    UNION
                    SELECT sire_status = 1 FROM horse h WHERE h.sire_uid = :horseUid:) tmp),
                h_sex.horse_sex_desc AS horse_sex,
                hc.rp_newspaper_output_desc AS horse_colour,
                h.sire_comment,
                s.total_win_dist_of_progeny AS s_total_win_dist_of_progeny,
                s.total_no_of_wins AS s_total_no_of_wins,
                shs.total_win_dist_of_progeny AS shs_total_win_dist_of_progeny,
                shs.total_no_of_wins AS shs_total_no_of_wins,
                shds.total_win_dist_of_progeny AS shds_total_win_dist_of_progeny,
                shds.total_no_of_wins AS shds_total_no_of_wins,
                s.total_earnings_of_progeny,
                s.total_no_of_horses,
                teas.total_earnings,
                teas.total_runners,
                ws.weatherbys_uid,
                weatherbys_api_uid = CONVERT(INT, ws.weatherbys_uid),
                rc.rabbah_uid AS owner_group_uid 
            FROM horse h
                LEFT JOIN sire sh ON sh.sire_uid = h.horse_uid
                LEFT JOIN sire ss ON ss.sire_uid = h.sire_uid
                LEFT JOIN horse_owner ho ON ho.horse_uid = h.horse_uid
                  AND ISNULL(ho.owner_change_date, '1900-01-01 00:00:00.0') = '1900-01-01 00:00:00.0'
                LEFT JOIN owner o ON o.owner_uid = ho.owner_uid
                LEFT JOIN horse_trainer ht ON ht.horse_uid = h.horse_uid
                  AND  isnull(ht.trainer_change_date,  '1900-01-01 00:00:00.0') = '1900-01-01 00:00:00.0'
                LEFT JOIN trainer t ON t.trainer_uid = ht.trainer_uid
                LEFT JOIN breeder b ON b.breeder_uid = h.breeder_uid
                LEFT JOIN horse hs ON hs.horse_uid = h.sire_uid
                LEFT JOIN horse hd ON hd.horse_uid = h.dam_uid
                LEFT JOIN horse hds ON hds.horse_uid = hd.sire_uid
                LEFT JOIN horse hss ON hss.horse_uid = hs.sire_uid
                LEFT JOIN sire sd ON sd.sire_uid = hd.sire_uid
                LEFT JOIN horse_sex h_sex ON h_sex.horse_sex_code = h.horse_sex_code
                LEFT JOIN horse_colour hc ON hc.horse_colour_code = h.horse_colour_code
                LEFT JOIN sires s ON s.sire_uid = h.horse_uid
                LEFT JOIN sires shs ON shs.sire_uid = hs.horse_uid
                LEFT JOIN sires shds ON shds.sire_uid = hds.horse_uid
                LEFT JOIN total_earnings_all_sires teas ON teas.total_uid = 1
                LEFT JOIN weatherbys_stallions ws ON ws.sire_uid = h.horse_uid AND ws.year = year(getDate())
                LEFT JOIN rabbah_config rc ON rc.owner_uid = o.owner_uid
            WHERE
                h.horse_uid = :horseUid:
            PLAN '(use optgoal allrows_dss)' 
            ",
            [
                'horseUid' => $horseId,
            ]
        );

        return (new \Phalcon\Mvc\Model\Resultset\General(null, new \Api\Row\Horse(), $result))->getFirst();
    }

    /**
     * @param $horseUid
     *
     * @return array
     */
    public function getToFollow($horseUid)
    {
        $sql = '
            SELECT
                tf.to_follow_uid
                , tf.to_follow_desc,
                tf.to_follow_code
            FROM horse_to_follow htf
                JOIN to_follow tf ON htf.to_follow_uid = tf.to_follow_uid
            WHERE
                htf.horse_uid = :horseUid
        ';

        $res = $this->getReadConnection()->query(
            $sql,
            ['horseUid' => $horseUid]
        );

        $to_follow_data = (new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        ))->toArrayWithRows();

        return empty($to_follow_data) ? null : $to_follow_data;
    }

    /**
     * @param $stallionId
     *
     * @return array
     */
    public function getStudFee($stallionId)
    {
        $priceOnAppSql = "UPPER(snf.stud_fee_condition) = 'PRIVATE'
                    OR UPPER(snf.stud_fee_condition) LIKE 'ON APPLICATION%'
                    OR UPPER(snf.stud_fee_condition) LIKE 'PRICE ON APPLICATION%'
                    OR UPPER(snf.stud_fee_condition) LIKE 'POA%'";
        $sql = "
            SELECT TOP 2 t.*
            FROM
            (
                SELECT
                    snf.nomination_fee,
                    snf.stud_fee_condition,
                    snf.year AS nomination_year,
                    stud.stud_name,
                    stud.country_code,
                    cur.cur_code,
                    cc.exchange_rate,
                    is_poa = (
                        SELECT
                        CASE
                            WHEN {$priceOnAppSql}
                            THEN 'Y'
                            ELSE 'N'
                        END
                    )
                FROM stallion_nomination_fees snf
                    LEFT JOIN stud stud ON stud.stud_uid = snf.stud_uid
                    LEFT JOIN currencies cur ON cur.cur_uid = snf.cur_uid
                    LEFT JOIN country_currencies cc ON (cc.cur_uid = snf.cur_uid AND cc.year = snf.year)
                WHERE snf.horse_uid = :stallionUid
                AND (
                        snf.nomination_fee > 0
                        OR (
                            {$priceOnAppSql}
                        )
                    )
            ) t
            ORDER BY t.nomination_year DESC
            ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'stallionUid' => $stallionId,
            ]
        );

        return (
        new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        )
        )->toArrayWithRows();
    }

    /**
     * @param array $horseUid
     *
     * @return array
     */
    public function getHorseDataForPedigree(array $horseUid)
    {
        $sql = "
            SELECT
                h.horse_uid,
                h.style_name,
                h.country_origin_code,
                h.horse_date_of_birth,
                h.sire_uid,
                h.dam_uid,
                h.horse_colour_code,
                h.horse_sex_code,
                sire.avg_flat_win_dist_of_progeny,
                rhc.rp_form_text
            FROM horse h
            LEFT JOIN sire ON sire.sire_uid = h.sire_uid
            LEFT JOIN racing_horse_comments rhc ON rhc.horse_uid = h.horse_uid
            WHERE
                h.horse_uid IN (:horseUid)
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            ['horseUid' => $horseUid]
        );

        $horses = new \Phalcon\Mvc\Model\Resultset\General(null, new \Api\Row\Horse(), $res);

        return $horses->toArrayWithRows('horse_uid');
    }

    /**
     * @param array $horseIds
     *
     * @return array
     * @throws \Api\Exception\NotFound
     */
    public function getSales($horseIds)
    {
        $result = null;
        $selectors = $this->getDI()->getShared('selectors');

        $currencySqlField = $selectors->getCurrencySqlField();
        $currencySqlCriteria = $selectors->getCurrencySqlCriteria();

        /*
         * Ensure that the tmp table #tmp_horse_ids does not already exist
         */
        $this->getReadConnection()->execute(
            "IF OBJECT_ID('tempdb..#tmp_horse_ids') IS NOT NULL DROP TABLE #tmp_horse_ids"
        );

        $sql = "
                SELECT
                    horse_uid
                INTO #tmp_horse_ids
                FROM
                    horse
                WHERE
                    horse_uid IN (:horseIds)
        ";

        $this->getReadConnection()->execute(
            $sql,
            [
                'horseIds' => $horseIds,
            ],
            null,
            false
        );

        $sql = "
                SELECT
                    h.horse_uid,
                    bs.buyer_detail,
                    bs.price,
                    bs.sale_date,
                    v.venue_desc venue_desc,
                    v.venue_uid,
                    bs.lot_no,
                    bs.lot_letter,
                    bs.seller_name,
                    CASE WHEN YEAR(bs.sale_date) = YEAR(h.horse_date_of_birth) THEN
                        '" . self::SALE_TYPE_FIRST . "'
                        WHEN YEAR(bs.sale_date) = YEAR(h.horse_date_of_birth) + 1 THEN
                        '" . self::SALE_TYPE_YEAR . "'
                        WHEN YEAR(bs.sale_date) = YEAR(h.horse_date_of_birth) + 2 
                            AND bsd.sale_name LIKE '%Breeze-Up%' THEN
                        '" . self::SALE_TYPE_BREATH_UP . "'
                        ELSE
                            NULL
                    END sale_type,
                    cur_code = {$currencySqlField},
                    bsd.sale_name,
                    bsd.abbrev_name
                FROM
                    horse h,
                    bloodstock_sale bs,
                    bloodstock_sale_date bsd,
                    venue v,
                    country_currencies cc,
                    currencies c
                WHERE
                    h.horse_uid IN (select horse_uid from #tmp_horse_ids)
                    AND bs.venue_uid *= bsd.venue_uid
                    AND bs.sale_date *= bsd.sale_date
                    AND v.venue_uid = bs.venue_uid
                    AND cc.cur_uid = c.cur_uid
                    AND cc.year = YEAR(bs.sale_date)
                    AND c.cur_code = {$currencySqlCriteria}
                    AND h.sire_uid = bs.sire_uid AND h.dam_uid = bs.dam_uid
                    AND bs.horse_age = YEAR(bs.sale_date) - YEAR(h.horse_date_of_birth)
                    AND cc.country_code =
                        CASE WHEN c.cur_uid = " . Constants::CURRENCY_USD_ID . "
                            THEN 'USA'
                        ELSE cc.country_code
                        END
             ORDER BY bs.sale_date DESC, bs.lot_no DESC
            ";

        $result = $this->getReadConnection()->query($sql);

        $result = new \Phalcon\Mvc\Model\Resultset\General(null, new \Phalcon\Mvc\Model\Row(), $result);

        $result = $result->getGroupedResult([
            'horse_uid',
            'sales' => [
                    'buyer_detail',
                    'price',
                    'sale_date',
                    'venue_desc',
                    'venue_uid',
                    'lot_no',
                    'lot_letter',
                    'seller_name',
                    'sale_type',
                    'cur_code',
                    'sale_name',
                    'abbrev_name'
                ]
            ], ['horse_uid']);

        /*
         * As a last step, drop the tmp table #tmp_horse_ids
         */
        $this->getReadConnection()->execute(
            "IF OBJECT_ID('tempdb..#tmp_horse_ids') IS NOT NULL DROP TABLE #tmp_horse_ids"
        );

        return $result;
    }

    /**
     * @param int $horseId
     *
     * @return array
     * @throws \Api\Exception\InternalServerError
     */
    public function getRelatives($horseId)
    {
        $result = null;
        $dam = null;

        $horse = static::find([
            "horse_uid = {$horseId}",
            "limit" => 1
        ])->getFirst();

        if ($horse) {
            $damUid = $horse->getDamUid();
            if (!empty($damUid)) {
                $dam = static::find([
                    "horse_uid = {$damUid}",
                    "limit" => 1
                ])->getFirst();
            }

            if ($dam) {
                $cutoffYear = date("Y", strtotime($dam->getHorseDateOfBirth())) + 4;
                if ($cutoffYear < 1988) {
                    $cutoffYear = 1988;
                }

                $this->getReadConnection()->execute(
                    "IF OBJECT_ID('tempdb..#tmp_horse_relatives') IS NOT NULL DROP TABLE #tmp_horse_relatives"
                );

                $sql = "
                SELECT
                    main_type = CASE WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                        THEN '" . strtoupper(Constants::RACE_TYPE_FLAT_ALIAS) . "'
                        ELSE '" . strtoupper(Constants::RACE_TYPE_JUMPS_ALIAS) . "'
                        END
                    , h.horse_uid
                    , h.style_name
                    , h.country_origin_code
                    , h_yob = YEAR(h.horse_date_of_birth)
                    , h.horse_sex_code
                    , wins = CASE WHEN ro.race_outcome_code = '1' THEN 1 ELSE 0 END
                    , places = CASE WHEN ro.race_outcome_code LIKE '[23]' THEN 1 ELSE 0 END
                    , total_prize_money = isnull(
                            CASE WHEN c.country_code = 'IRE'
                            THEN rip.prize_euro_gross / CASE WHEN ccr.exchange_rate = 0 THEN 1 ELSE ccr.exchange_rate END
                            ELSE rip.prize_sterling END, 0)
                    , euro_total_prize = isnull(CASE WHEN c.country_code = 'IRE' THEN rip.prize_euro_gross END, 0)
                    , stakes_winner =
                            CASE WHEN isnull(rg.race_group_uid, 0) IN (0, 6)
                                OR ro.race_outcome_code NOT LIKE '[123]'
                            THEN 0
                            ELSE 1
                            END
                    , sire_uid = sire.horse_uid
                    , sire_style_name = sire.style_name
                    , sire_ctry_orig = sire.country_origin_code
                    , hr.rp_postmark
                    , sawd.avg_flat_win_dist_of_progeny
                    , ri.distance_yard
                INTO #tmp_horse_relatives
                FROM
                    horse h
                    , horse_race hr
                    , race_instance ri
                    , race_outcome ro
                    , horse sire
                    , race_instance_prize rip
                    , race_group rg
                    , sire sawd
                    , course c
                    , country_currencies ccr
                WHERE
                    h.dam_uid = :damId
                    AND hr.horse_uid != :horseId
                    AND hr.horse_uid = h.horse_uid
                    AND ri.race_instance_uid = hr.race_instance_uid
                    AND ri.race_status_code =  " . Constants::RACE_STATUS_RESULTS . "
                    AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                    AND YEAR(ri.race_datetime) >= :startYear
                    AND ro.race_outcome_uid = hr.final_race_outcome_uid
                    AND ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
                    AND sire.horse_uid = h.sire_uid
                    AND rip.race_instance_uid =* hr.race_instance_uid
                    AND rip.position_no =* ro.race_outcome_position
                    AND rg.race_group_uid =* ri.race_group_uid
                    AND sawd.sire_uid =* h.sire_uid
                    AND ri.course_uid = c.course_uid
                    AND ccr.country_code = 'EUR' AND ccr.year =* year(ri.race_datetime)
            ";

                $this->getReadConnection()->execute(
                    $sql,
                    [
                        'damId' => $horse->getDamUid(),
                        'startYear' => $cutoffYear,
                        'horseId' => $horseId
                    ],
                    null,
                    false
                );

                $sql = "
                SELECT
                    t.*,
                    trainer.trainer_uid,
                    trainer_name = trainer.style_name
                FROM
                    (SELECT
                        res.main_type
                        , res.horse_uid
                        , res.style_name
                        , res.country_origin_code
                        , res.h_yob
                        , res.horse_sex_code
                        , res.sire_uid
                        , res.sire_style_name
                        , res.sire_ctry_orig
                        , res.avg_flat_win_dist_of_progeny
                        , runs = COUNT(1)
                        , wins = SUM(res.wins)
                        , places = SUM(res.places)
                        , total_prize_money = CONVERT(MONEY, SUM(res.total_prize_money))
                        , euro_total_prize = CONVERT(MONEY, SUM(res.euro_total_prize))
                        , stakes_winner = SUM(res.stakes_winner)
                        , rp_postmark = MAX(res.rp_postmark)
                        , distance_yard = (
                            SELECT MAX(distance_yard) FROM #tmp_horse_relatives r1
                            WHERE
                                r1.rp_postmark = (
                                  SELECT MAX(r2.rp_postmark)
                                  FROM #tmp_horse_relatives r2
                                  WHERE r2.horse_uid = r1.horse_uid
                                        AND r2.main_type = r1.main_type
                                )
                                AND r1.horse_uid = res.horse_uid
                                AND r1.main_type = res.main_type
                            GROUP BY horse_uid
                        )
                    FROM #tmp_horse_relatives res
                    GROUP BY
                        main_type
                        , horse_uid
                        , style_name
                        , country_origin_code
                        , h_yob
                        , horse_sex_code
                        , res.sire_uid
                        , sire_style_name
                        , sire_ctry_orig
                        , avg_flat_win_dist_of_progeny

                        ) t
                JOIN horse_race hr2 ON
                    1 = CASE WHEN t.rp_postmark IS NULL AND hr2.rp_postmark IS NULL
                        OR t.rp_postmark = hr2.rp_postmark THEN 1 ELSE 0 END
                    AND hr2.horse_uid = t.horse_uid
                    AND hr2.race_instance_uid = (
                        SELECT
                            MAX(hr1.race_instance_uid)
                        FROM
                            horse_race hr1,
                            race_instance ri
                        WHERE
                            1 = CASE WHEN t.rp_postmark IS NULL AND hr1.rp_postmark IS NULL
                                OR t.rp_postmark = hr1.rp_postmark THEN 1 ELSE 0 END
                            AND hr1.horse_uid = t.horse_uid
                            AND ri.race_instance_uid = hr1.race_instance_uid
                            AND ri.race_type_code LIKE (
                                CASE 
                                    WHEN t.main_type = '" . strtoupper(Constants::RACE_TYPE_FLAT_ALIAS) . "' 
                                    THEN :flatLikeCodes
                                    ELSE :jumpsLikeCodes
                                END
                            )
                    )
                LEFT JOIN trainer ON trainer.trainer_uid = hr2.trainer_uid
                ORDER BY
                    t.main_type
                    , t.rp_postmark DESC
                    , t.total_prize_money DESC
                    , t.wins
                    , t.runs
                ";

                $result = $this->getReadConnection()->query(
                    $sql,
                    [
                        'flatLikeCodes' => '[' . str_replace([' ', ',', '\''], '', Constants::RACE_TYPE_FLAT) . ']',
                        'jumpsLikeCodes' => '[' . str_replace([' ', ',', '\''], '', Constants::RACE_TYPE_JUMPS) . ']'
                    ]
                );
                $result = new \Phalcon\Mvc\Model\Resultset\General(
                    null,
                    new \Api\Row\HorseProfile\Relative(),
                    $result
                );
                $result = $result->toArrayWithRows('main_type', null, true);

                $this->getReadConnection()->execute(
                    "IF OBJECT_ID('tempdb..#tmp_horse_relatives') IS NOT NULL DROP TABLE #tmp_horse_relatives"
                );
            }
        }

        return $result;
    }
}
