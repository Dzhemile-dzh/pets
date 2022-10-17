<?php

namespace Api\DataProvider\Bo;

use Api\Constants\Horses as Constants;
use Api\DataProvider\HorsesDataProvider;
use Phalcon\Db\Sql\Builder;
use Phalcon\DI;

/**
 * Class Tippings
 *
 * @package Api\DataProvider\Bo
 */
class Tipping extends HorsesDataProvider
{
    /**
     * @param string $raceDate
     * @return array
     */
    public function getTippings(string $raceDate)
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                prtv.race_instance_uid,
                ri.race_datetime,
                ri.race_status_code,
                course_name = c.style_name,
                diffusion_course_name = c.course_name,
                horse_name = h.style_name,
                h.horse_uid,
                phr.saddle_cloth_no,
                ho.owner_uid,
                vs_newspaper_uid = vs.newspaper_uid,
                n.newspaper_uid,
                vs.selection_desc,
                jockey_name = j.style_name,
                trainer_name = t.style_name,
                prtv.verdict,
                rtip.tipster_uid,
                rtip.tipster_name,
                tipster_type = n.newspaper_name,
                phr.non_runner,
                spotlight_tip_verdict = null
            FROM pre_race_tipster_verdicts prtv
            JOIN race_instance ri ON ri.race_instance_uid = prtv.race_instance_uid
            LEFT JOIN course c ON c.course_uid = ri.course_uid
            LEFT JOIN verdict_selection vs ON vs.tipster_uid = prtv.tipster_uid
                AND vs.race_instance_uid = prtv.race_instance_uid
                AND vs.newspaper_uid = prtv.newspaper_uid
            LEFT JOIN horse h ON h.horse_uid = vs.horse_uid
            LEFT JOIN pre_horse_race phr ON phr.race_instance_uid = ri.race_instance_uid
                AND phr.horse_uid = vs.horse_uid
                AND phr.race_status_code = (
                    CASE
                        WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                        THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                        ELSE ri.race_status_code
                    END)
            LEFT JOIN jockey j ON j.jockey_uid = phr.jockey_uid
            LEFT JOIN horse_owner ho ON ho.horse_uid = h.horse_uid
                AND ho.owner_change_date = ISNULL(
                    (
                        SELECT MIN(ho2.owner_change_date)
                        FROM horse_owner ho2
                        WHERE ho2.horse_uid = ho.horse_uid AND ho2.owner_change_date >= ri.race_datetime
                    ),
                    CONVERT(DATETIME, '1 jan 1900')
                )
            LEFT JOIN horse_trainer ht ON ht.horse_uid = h.horse_uid AND ht.trainer_change_date = '1900'
            LEFT JOIN trainer t ON t.trainer_uid = ht.trainer_uid
            LEFT JOIN rp_tipsters rtip ON rtip.tipster_uid = prtv.tipster_uid
            LEFT JOIN newspapers n ON n.newspaper_uid = vs.newspaper_uid
            WHERE
                CONVERT(varchar(10), ri.race_datetime, 23) = :raceDate
                AND n.newspaper_uid IN (:tipping_single_ids)
            ORDER BY ri.race_datetime
        ");

        $builder
            ->setParam('raceDate', $raceDate)
            ->setParam('tipping_single_ids', Constants::TIPPING_SINGLES_IDS_ARRAY);

        $result = $this->queryBuilder($builder);

        return $result->toArrayWithRows();
    }

    /**
     * Get multiples tipping.
     * Tips are restricted to matches in the metatags DB.
     * Do not display any tips which are in “ignore” Tip Category / category_uid = 3.
     *
     * - A/C from https://racingpost.atlassian.net/browse/AD-1603
     *
     * @param string $raceDate
     * @return array
     */
    public function getMultiplesTipping(string $raceDate)
    {
        $builder = new Builder();

        // The query bellow uses metatags database so we need to get the dynamic name of it.
        $metatagsDb = DI::getDefault()
            ->getShared('selectors')
            ->getDb()
            ->getMetatagsDb();

        $builder->setSqlTemplate("
            SELECT
                prtv.race_instance_uid,
                ri.race_datetime,
                course_name = c.style_name,
                diffusion_course_name = c.course_name,
                horse_name = h.style_name,
                h.horse_uid,
                phr.saddle_cloth_no,
                ho.owner_uid,
                vs.newspaper_uid,
                vs.selection_desc,
                jockey_name = j.style_name,
                trainer_name = t.style_name,
                prtv.verdict,
                tcc.tipster_uid,
                tcc.tipster_name,
                tcc.tipster_type,
                phr.non_runner,
                tsc.category_uid,
                tsc.tip_category,
                tsc.max_tips,
                tsc.min_tips
            FROM pre_race_tipster_verdicts prtv
            JOIN race_instance ri ON ri.race_instance_uid = prtv.race_instance_uid
            JOIN verdict_selection vs ON vs.tipster_uid = prtv.tipster_uid
                AND vs.race_instance_uid = prtv.race_instance_uid
                AND vs.newspaper_uid = prtv.newspaper_uid
            LEFT JOIN course c ON c.course_uid = ri.course_uid
            LEFT JOIN horse h ON h.horse_uid = vs.horse_uid
            LEFT JOIN pre_horse_race phr ON phr.race_instance_uid = ri.race_instance_uid
                AND phr.horse_uid = vs.horse_uid
                AND phr.race_status_code = (
                    CASE
                        WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                        THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                        ELSE ri.race_status_code
                    END)
            LEFT JOIN jockey j ON j.jockey_uid = phr.jockey_uid
            LEFT JOIN horse_owner ho ON ho.horse_uid = h.horse_uid
                AND ho.owner_change_date = ISNULL(
                    (
                        SELECT MIN(ho2.owner_change_date)
                        FROM horse_owner ho2
                        WHERE ho2.horse_uid = ho.horse_uid AND ho2.owner_change_date >= ri.race_datetime
                    ),
                    CONVERT(DATETIME, '1 jan 1900')
                )
            LEFT JOIN horse_trainer ht ON ht.horse_uid = h.horse_uid AND ht.trainer_change_date = '1900'
            LEFT JOIN trainer t ON t.trainer_uid = ht.trainer_uid
            INNER JOIN {$metatagsDb}..tipster_category_config tcc ON tcc.tipster_uid = prtv.tipster_uid
                AND tcc.newspaper_uid = prtv.newspaper_uid
            INNER JOIN {$metatagsDb}..tipster_selections_config tsc ON tsc.category_uid = tcc.category_uid
            WHERE
                CONVERT(varchar(10), ri.race_datetime, 23) = :raceDate
                -- we do not want to display tips with category 3 (classed as ignore category)
                AND tsc.category_uid != 3
                AND phr.non_runner IS NULL OR phr.non_runner != 'Y'
            ORDER BY 
                tsc.category_uid,
                ri.race_datetime,
                tcc.tipster_score desc,
                phr.saddle_cloth_no,
                tcc.tipster_name
        ");

        $builder
            ->setParam('raceDate', $raceDate);

        $result = $this->queryBuilder($builder);
        $result = $result->getGroupedResult(
            [
                'tips' => [
                    'race_instance_uid',
                    'race_datetime',
                    'course_name',
                    'diffusion_course_name',
                    'horse_name',
                    'horse_uid',
                    'saddle_cloth_no',
                    'owner_uid',
                    'newspaper_uid',
                    'selection_desc',
                    'jockey_name',
                    'trainer_name',
                    'verdict',
                    'tipster_uid',
                    'tipster_name',
                    'tipster_type',
                    'non_runner',
                    'category_uid',
                    'tip_category',
                    'max_tips',
                    'min_tips'
                ],
                'races' => [
                    'race_instance_uid'
                ],
                'tip_category',
                'max_tips',
                'min_tips'
            ],
            ['tip_category']
        );

        return $result;
    }

    /**
     * @return array
     */
    public function getSuccessfulTippings()
    {
        $latestTippingsTmpTable = '#latest_tippings';

        $builder = new Builder();
        $builder->setSqlTemplate("
                   SELECT 
                        ri.race_datetime,
                        vs.tipster_uid
                   INTO {$latestTippingsTmpTable}
                   FROM pre_race_tipster_verdicts prtv
                      JOIN verdict_selection vs ON vs.tipster_uid = prtv.tipster_uid
                        AND vs.race_instance_uid = prtv.race_instance_uid
                        AND vs.newspaper_uid = prtv.newspaper_uid
                      JOIN race_instance ri ON ri.race_instance_uid = prtv.race_instance_uid
                   WHERE ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                    AND vs.newspaper_uid in (:tippingUids)
                   GROUP BY vs.tipster_uid
                   HAVING ri.race_datetime = MAX(ri.race_datetime)");

        $builder->setParam('tippingUids', Constants::TIPPING_SINGLES_IDS_ARRAY);

        $this->queryBuilder($builder);

        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                ri.race_datetime,
                ri.race_instance_uid,
                course_name = c.style_name,
                diffusion_course_name = c.course_name,
                horse_name = h.style_name,
                h.horse_uid,
                rtip.tipster_uid,
                rtip.tipster_name,
                tipster_type = n.newspaper_name,
                hr.race_outcome_uid,
                o.odds_desc,
                o.odds_value
            FROM pre_race_tipster_verdicts prtv
            JOIN race_instance ri ON ri.race_instance_uid = prtv.race_instance_uid
            JOIN {$latestTippingsTmpTable} lt ON lt.race_datetime = ri.race_datetime
                AND prtv.tipster_uid = lt.tipster_uid
            JOIN course c ON c.course_uid = ri.course_uid
            JOIN verdict_selection vs ON vs.tipster_uid = prtv.tipster_uid
                AND vs.race_instance_uid = prtv.race_instance_uid
                AND vs.newspaper_uid = prtv.newspaper_uid
            JOIN horse h ON h.horse_uid = vs.horse_uid
            JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
                AND hr.horse_uid = vs.horse_uid
            JOIN odds o ON hr.starting_price_odds_uid = o.odds_uid
            JOIN rp_tipsters rtip ON rtip.tipster_uid = prtv.tipster_uid
            JOIN newspapers n ON n.newspaper_uid = vs.newspaper_uid
            WHERE
                hr.race_outcome_uid IN (:winnersOutcomeUids)
            ORDER BY vs.tipster_uid, ri.race_datetime
        ");

        $builder->setParam('winnersOutcomeUids', Constants::WINNER_IDS_ARRAY);

        $result =  $this->queryBuilder($builder);

        $resultArr = $result->toArrayWithRows('tipster_uid');
        $this->execute("IF OBJECT_ID('#{$latestTippingsTmpTable}') IS NOT NULL DROP TABLE #{$latestTippingsTmpTable}");

        return $resultArr;
    }

    /**
     * This query should return all winning spotlight tips from the given date and forward.
     *
     * @param string $raceDateMinusOneDay
     * @return array
     */
    public function getSpotlightTips(string $raceDateMinusOneDay)
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
        SELECT 
            ri.race_datetime,
            ri.race_instance_uid,
            h.horse_uid,
            hr.race_outcome_uid,
            rtip.tipster_uid,
            rtip.tipster_name,
            o.odds_desc,
            o.odds_value,
            tipster_type = np.newspaper_name,
            course_name  = c.style_name,
            horse_name   = h.style_name
        FROM tipster_selection ts
            JOIN race_instance ri ON ts.race_instance_uid = ri.race_instance_uid
            JOIN  newspapers np ON np.newspaper_uid = ts.newspaper_uid 
              AND np.newspaper_uid = 1
            JOIN course c ON c.course_uid = ri.course_uid
            JOIN horse h ON h.horse_uid = ts.horse_uid
            JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid 
              AND hr.horse_uid = ts.horse_uid
            JOIN odds o ON hr.starting_price_odds_uid = o.odds_uid
            JOIN rp_tipsters rtip ON rtip.tipster_uid = ts.tipster_uid
        WHERE 
            CONVERT(varchar(10), ri.race_datetime, 23) >= :raceDate
        ORDER BY ri.race_datetime
        ");

        $builder->setParam('winnersOutcomeUids', Constants::WINNER_IDS_ARRAY);
        $builder->setParam('raceDate', $raceDateMinusOneDay);

        $result =  $this->queryBuilder($builder);

        $resultArr = $result->toArrayWithRows('tipster_uid', null, true);

        return $resultArr;
    }

    /**
     * This query should return all upcoming spotlight tips for the given day
     *
     * @param string $raceDate
     * @return array
     */
    public function getUpcomingSpotlightTipsForTheDay(string $raceDate)
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
        SELECT
          ri.race_datetime,
          ri.race_instance_uid,
          course_name = c.style_name,
          diffusion_course_name = c.course_name,
          horse_name = h.style_name,
          h.horse_uid,
          phr.saddle_cloth_no,
          ri.race_status_code,
          rtip.tipster_uid,
          rtip.tipster_name,
          tipster_type = np.newspaper_name,
          spotlight_tip_verdict = CASE
                                    WHEN EXISTS
                                      (SELECT 1 FROM race_content_publish_time rcpt
                                       WHERE rcpt.race_content_publish_race_uid = ri.race_instance_uid
                                         AND rcpt.race_content_publish_time <= GETDATE()
                                         AND rcpt.race_content_type_uid = 1)
                                      THEN pric.rp_verdict ELSE NULL
            END
        FROM tipster_selection ts
               JOIN race_instance ri ON ts.race_instance_uid = ri.race_instance_uid
               JOIN pre_race_instance_comments pric ON pric.race_instance_uid = ri.race_instance_uid
               JOIN  newspapers np ON np.newspaper_uid = ts.newspaper_uid AND np.newspaper_uid = 1
               JOIN course c ON c.course_uid = ri.course_uid
               JOIN horse h ON h.horse_uid = ts.horse_uid
               JOIN rp_tipsters rtip ON rtip.tipster_uid = ts.tipster_uid
               JOIN pre_horse_race phr ON phr.race_instance_uid = ri.race_instance_uid
                    AND phr.horse_uid = ts.horse_uid
                    AND phr.race_status_code = (
                        CASE
                          WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                          THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                        ELSE ri.race_status_code
                    END)
        WHERE
          CONVERT(varchar(10), ri.race_datetime, 23) = :raceDate
        ORDER BY ri.race_datetime
        ");

        $builder->setParam('raceDate', $raceDate);

        $result =  $this->queryBuilder($builder);

        $resultArr = $result->toArrayWithRows();

        return $resultArr;
    }
}
