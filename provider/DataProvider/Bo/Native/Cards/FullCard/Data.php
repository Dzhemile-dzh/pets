<?php

declare(strict_types=1);

namespace Api\DataProvider\Bo\Native\Cards\FullCard;

use Api\DataProvider\HorsesDataProvider;
use Api\Input\Request\Horses\Native\Cards\FullCard as Request;
use Phalcon\Db\Sql\Builder;
use Api\Row\RaceInstance as RaceRow;
use Api\Row\Results\Horse as HorseRow;
use \Api\Bo\Traits\FinalRaceCheck;
use Api\Constants\Horses as Constants;

/**
 * @package Bo\Native\Cards
 */
class Data extends HorsesDataProvider
{
    use FinalRaceCheck;

    /**
     * @param Request $request
     *
     * @return RaceRow|null
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getRace(Request $request): ?RaceRow
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                ri.race_instance_uid,
                ri.race_datetime,
                ri.race_status_code,
                ri.race_instance_title,
                bookmaker = 'William Hill',
                aa.rp_ages_allowed_desc,
                (
                    SELECT DISTINCT ral.race_attrib_desc
                    FROM race_attrib_join raj, race_attrib_lookup ral
                    WHERE ri.race_instance_uid = raj.race_instance_uid
                    AND raj.race_attrib_uid = ral.race_attrib_uid
                    AND ral.race_attrib_code = (
                       CASE WHEN c.country_code = 'GB'
                            THEN " . Constants::RACE_CLASS_SUB . "
                            ELSE " . Constants::RACE_CLASS . "
                        END
                    )
                ) AS race_class,
                pri.distance_yard,
                pric.rp_tv_text,
                gt.going_type_desc,
                c.course_uid,
                c.course_name,
                c.style_name course_style_name,
                country_code = RTRIM(c.country_code),
                ri.race_type_code,
                rt.race_type_desc,
                pr.perform_race_uid perform_race,
                pr.isATR is_atr,
                CASE WHEN rg.race_group_uid = 0 THEN NULL ELSE rg.race_group_desc END AS race_group_desc,
                ri.going_type_code,
                rg.race_group_code

            FROM race_instance ri
            INNER JOIN course c ON ri.course_uid = c.course_uid
            INNER JOIN pre_race_instance pri ON pri.race_instance_uid = ri.race_instance_uid
            LEFT JOIN ages_allowed aa ON aa.ages_allowed_uid = ri.ages_allowed_uid
            LEFT JOIN pre_race_instance_comments pric ON pric.race_instance_uid = ri.race_instance_uid
            LEFT JOIN going_type gt ON gt.going_type_code = ri.going_type_code
            LEFT JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid AND ri.race_group_uid != 0
            LEFT JOIN race_type rt ON rt.race_type_code = ri.race_type_code
            LEFT JOIN perform_race pr ON pr.race_instance_uid = ri.race_instance_uid

            WHERE
                ri.race_instance_uid = :raceId
                AND CASE WHEN pri.race_status_code = " . Constants::RACE_STATUS_RESULTS . " THEN '-1' ELSE
                        CASE WHEN pri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . " THEN '0' ELSE pri.race_status_code END
                    END = (
                        SELECT MIN(CASE WHEN ipri.race_status_code = " . Constants::RACE_STATUS_RESULTS . " THEN '-1' ELSE
                            CASE WHEN ipri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . " THEN '0' ELSE ipri.race_status_code END END)
                        FROM pre_race_instance ipri
                        WHERE ipri.race_instance_uid = ri.race_instance_uid
                        GROUP BY ipri.race_instance_uid
                )
        ");
        $builder->setParam('raceId', $request->getRaceId());
        $builder->setRow(new RaceRow());

        $rtn =  $this->queryBuilder($builder);

        return $rtn->getFirst() ?: null;
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function getBetOffers(Request $request): array
    {
        $storiesDB = $this->getDI()->get('selectors')->getDb()->getStoriesDb();
        $builder = new Builder();

        $conditionalSql = 'CASE';

        // We loop through each bookmaker to add these conditional statements to the SQL
        foreach (array_keys(Constants::BET_OFFERS_ARRAY) as $bookmakerBetOffer) {
            if (!empty(Constants::BETOFFER_STORIES_IDS[$bookmakerBetOffer])) {
                $conditionalSql .= ' WHEN raj.race_attrib_uid = ' . $bookmakerBetOffer . ' THEN '
                    . Constants::BETOFFER_STORIES_IDS[$bookmakerBetOffer];
            }
        }
        $conditionalSql .= " END";

        $builder->setSqlTemplate("
            SELECT
                s.synopsis,
                s.story,
                raj.race_attrib_uid
            FROM race_attrib_join raj
            INNER JOIN race_attrib_lookup ral ON ral.race_attrib_uid = raj.race_attrib_uid
            INNER JOIN {$storiesDB}..story s ON s.story_uid = $conditionalSql
            WHERE raj.race_attrib_uid IN (:race_attrib_uid)
                AND raj.race_instance_uid = :race_uid
        ");
        $builder->setParam('race_uid', $request->getRaceId());
        $builder->setParam('race_attrib_uid', array_keys(Constants::BETOFFER_STORIES_IDS));

        $rtn =  $this->queryBuilder($builder);

        return $rtn->toArrayWithRows();
    }

    /**
     * @param RaceRow $raceInstance
     *
     * @return array
     */
    public function getRunners(RaceRow $raceInstance): array
    {
        $builder = new Builder();

        $selectors = $this->getDI()->get('selectors');

        $ageSql = $selectors->getHorseAgeSQL(
            'h.horse_date_of_birth',
            'h.country_origin_code',
            'ri.race_datetime'
        );

        $builder->setSqlTemplate("
                 SELECT
                    phr.saddle_cloth_no,
                    CASE WHEN phr.draw = 0 THEN NULL ELSE phr.draw END draw,
                    ho.owner_uid,
                    h.horse_uid,
                    
                    ri.race_type_code,
                    ri.race_instance_uid,
                    ri.race_datetime,
                    c.course_uid,
                    ri.distance_yard,
                    course_country_code = c.country_code,
                    ri.track_code,
                    ri.straight_round_jubilee_code,
                    ri.race_group_uid,
                    
                    horse_name = h.style_name,
                    h.country_origin_code,
                    hhg.rp_horse_head_gear_code,
                    horse_age = {$ageSql},
                    phr.weight_carried_lbs,
                    phr.official_rating,
                    j.jockey_uid,
                    jockey_name = j.style_name,
                    trainer_uid = t.trainer_uid,
                    trainer_stylename = t.style_name,
                    pd.num_topspeed_best_rating,
                    phr.rp_topspeed,
                    phr.rp_postmark,
                    phr.rp_owner_choice,
                    phr.non_runner,
                    phr.doubtful_runner,
                    irb_flat_form_string = (
                         CASE
                             WHEN c.country_code NOT IN('" . Constants::COUNTRY_GB . "', '" . Constants::COUNTRY_IRE . "')  THEN rihc.irb_flat_form_string
                         END
                    ),
                    irish_reserve_yn = (
                        CASE
                            WHEN isnull(rtrim(phr.irish_reserve_yn),'N') = 'N' THEN 'N'
                            ELSE rtrim(phr.irish_reserve_yn)
                        END
                    ),
                    allowance = (CASE WHEN phr.weight_allowance_lbs < 1 THEN NULL ELSE phr.weight_allowance_lbs END),
                    h.horse_sex_code,
                    hs.horse_sex_desc,
                    spotlight = CASE WHEN EXISTS (
                        SELECT 1 FROM race_content_publish_time rcpt
                        WHERE rcpt.race_content_publish_race_uid = ri.race_instance_uid
                        AND rcpt.race_content_publish_time <= GETDATE()
                        AND rcpt.race_content_type_uid = " . Constants::RACE_CONTENT_TYPE_TIPSTERS_VERDICTS . "
                    )
                    THEN phrc.rp_current_spotlight ELSE NULL END,
                    diomed = CASE WHEN EXISTS (
                        SELECT 1 FROM race_content_publish_time rcpt
                        WHERE rcpt.race_content_publish_race_uid = phrg.race_instance_uid
                        AND rcpt.race_content_publish_time <= GETDATE()
                        AND rcpt.race_content_type_uid = " . Constants::RACE_CONTENT_TYPE_TIPSTERS_VERDICTS . "
                    )
                    THEN phrg.varchar_255 ELSE NULL END,
                    figures = (
                        CASE
                            WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ") THEN rihc.irb_flat_form_string
                            ELSE rihc.irb_jump_form_string
                        END
                    ),
                    figures_calculated = NULL,
                    beaten_favourite = 'N',
                    course_and_distance_wins = (
                        CASE WHEN c.country_code = 'GB' OR c.country_code = 'IRE' THEN 0 ELSE NULL END
                    ),
                    course_wins = (CASE WHEN c.country_code = 'GB' OR c.country_code = 'IRE' THEN 0 ELSE NULL END),
                    distance_wins = (CASE WHEN c.country_code = 'GB' OR c.country_code = 'IRE' THEN 0 ELSE NULL END),
                    tips_qty = 0,
                    days_since_last_run = null,
                    CASE WHEN hr.extra_weight_lbs IS NOT NULL 
                        THEN hr.extra_weight_lbs ELSE phr.extra_weight_lbs 
                    END extra_weight_lbs
                FROM
                    race_instance ri
                    INNER JOIN pre_horse_race phr ON phr.race_instance_uid = ri.race_instance_uid
                    INNER JOIN horse h ON h.horse_uid = phr.horse_uid
                    LEFT JOIN horse_race hr ON hr.horse_uid = h.horse_uid AND  hr.race_instance_uid = ri.race_instance_uid
                    LEFT JOIN racing_horse_comments rihc ON rihc.horse_uid = h.horse_uid
                    LEFT JOIN horse_sex hs ON hs.horse_sex_code = h.horse_sex_code 
                    LEFT JOIN jockey j ON j.jockey_uid = phr.jockey_uid
                    LEFT JOIN horse_head_gear hhg ON hhg.horse_head_gear_uid = phr.horse_head_gear_uid
                    LEFT JOIN postdata_results_new pd ON pd.race_instance_uid = phr.race_instance_uid
                        AND pd.horse_uid = phr.horse_uid
                    LEFT JOIN pre_horse_race_comments phrc ON phrc.race_instance_uid = phr.race_instance_uid
                        AND phrc.horse_uid = phr.horse_uid
                    LEFT JOIN pre_horse_race_genlkup phrg ON phrg.race_instance_uid = ri.race_instance_uid
                        AND phrg.horse_uid = phr.horse_uid
                    LEFT JOIN horse_owner ho ON ho.horse_uid = h.horse_uid AND
                        ho.owner_change_date = isnull(
                            (
                                SELECT MIN(hoi.owner_change_date)
                                FROM horse_owner hoi
                                WHERE hoi.horse_uid = ho.horse_uid AND hoi.owner_change_date >= ri.race_datetime
                            ),
                            CONVERT(DATETIME, '1 jan 1900')
                        )
                    INNER JOIN course c ON c.course_uid = ri.course_uid
                    LEFT JOIN horse_trainer ht ON ht.horse_uid = phr.horse_uid AND ht.trainer_change_date = '1900'
                    LEFT JOIN trainer t ON t.trainer_uid = ht.trainer_uid
                WHERE
                    phr.race_status_code = (
                        CASE
                            WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                            THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                            ELSE ri.race_status_code
                        END)
                    AND ri.race_instance_uid = :raceId
            ORDER BY phr.saddle_cloth_no, h.style_name
        ");

        $builder->setParam('raceId', $raceInstance->race_instance_uid);

        $builder->build();
        $builder->setRow(new HorseRow());

        $collection = $this->queryBuilder($builder);

        return $collection->toArrayWithRows('horse_uid');
    }

    /**
     * @param int    $raceId
     *
     * @return array
     */
    public function getPrizes(int $raceId): array
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
            SELECT
                position_no
                , position_template = 'prizePos%d'
                , prize_template = '%.2f'
                , prize_sterling = ROUND(prize_sterling, 2)
                , prize_euro = CASE WHEN prize_euro IS NULL THEN NULL ELSE ROUND(prize_euro, 2) END
            FROM
                race_instance_prize
            WHERE
                race_instance_uid = :raceId
        ");

        $builder->setParam('raceId', $raceId);

        $builder->build();

        $prizes = $this->queryBuilder($builder);

        return $prizes->toArrayWithRows();
    }

    public function getDaysSinceLastRun($horseIds, $raceDate, $raceTypeCode)
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
         
        SELECT
              horse_uid,
              race_type_code,
              days_since_run =  DATEDIFF(DAY, race_datetime, :raceDatetime)
        FROM
              race_instance ri
        LEFT JOIN horse_race hr ON ri.race_instance_uid = hr.race_instance_uid
        WHERE
              hr.horse_uid IN (:horseids)
            AND ri.race_datetime 
                IN (SELECT t.race_datetime
		            FROM (
                        SELECT
                              hr1.horse_uid, 
                              MAX(ri1.race_datetime) race_datetime
                        FROM
                            horse_race hr1
                        LEFT JOIN race_instance ri1 ON hr1.race_instance_uid = ri1.race_instance_uid
                        WHERE
                            hr1.race_outcome_uid NOT IN (".Constants::NON_RUNNER_IDS.")
                        AND hr1.horse_uid IN (:horseids)
                        AND CASE WHEN ri1.race_type_code IN (".Constants::RACE_TYPE_FLAT.") THEN 'F'
                            WHEN ri1.race_type_code IN (".Constants::RACE_TYPE_JUMPS.") THEN 'J'
                            ELSE 'P' END = :raceTypeCode
                        AND ri1.race_datetime < :raceDatetime
                        GROUP BY 
                                hr1.horse_uid
                        UNION
                        
                        SELECT
                              hr1.horse_uid, 
                              MAX(ri1.race_datetime) race_datetime
                        FROM
                            horse_race hr1
                        LEFT JOIN race_instance ri1 ON hr1.race_instance_uid = ri1.race_instance_uid
                        WHERE
                            hr1.race_outcome_uid NOT IN (".Constants::NON_RUNNER_IDS.")
                        AND hr1.horse_uid IN (:horseids)
                        AND ri1.race_datetime < :raceDatetime
                        GROUP BY 
                                hr1.horse_uid
                       
                        ) t
                    WHERE t.horse_uid = hr.horse_uid
                    )");

        $builder->setParam('raceDatetime', $raceDate);
        $builder->setParam('horseids', $horseIds);
        $builder->setParam('raceTypeCode', $raceTypeCode);

        $builder->build();

        $result = $this->queryBuilder($builder);

        return $result->toArrayWithRows();
    }
}
