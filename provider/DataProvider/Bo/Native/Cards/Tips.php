<?php

declare(strict_types=1);

namespace Api\DataProvider\Bo\Native\Cards;

use Phalcon\Db\Sql\Builder;
use Api\Row\RaceInstance as RaceRow;
use Api\Row\Results\Horse as HorseRow;
use Api\Constants\Horses as Constants;
use Api\DataProvider\HorsesDataProvider;
use Phalcon\Mvc\Model\Resultset\ResultsetException;

/**
 * @package Api\DataProvider\Bo\Native\Cards
 */
class Tips extends HorsesDataProvider
{
    /**
     * @param int $raceId
     *
     * @return RaceRow|null
     * @throws ResultsetException
     */
    public function getRace(int $raceId): ?RaceRow
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                ri.race_instance_uid,
                ri.race_datetime,
                ri.race_status_code,
                ri.race_instance_title,
                bookmaker = 'William Hill',
                race_class = (
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
                ),
                pri.no_of_runners,
                pri.distance_yard,
                gt.going_type_desc,
                c.course_uid,
                c.course_name,
                c.style_name course_style_name,
                country_code = RTRIM(c.country_code),
                ri.race_type_code,
                CASE WHEN rg.race_group_uid = 0 THEN NULL ELSE rg.race_group_desc END AS race_group_desc,
                ri.going_type_code,
                rg.race_group_code,
                rp_verdict = CASE WHEN EXISTS (
                        SELECT 1 FROM race_content_publish_time rcpt
                        WHERE rcpt.race_content_publish_race_uid = ri.race_instance_uid
                        AND rcpt.race_content_publish_time <= GETDATE()
                        AND rcpt.race_content_type_uid = " . Constants::RACE_CONTENT_TYPE_TIPSTERS_VERDICTS . "
                    )
                    THEN pric.rp_verdict ELSE NULL END
            FROM race_instance ri
                INNER JOIN course c ON ri.course_uid = c.course_uid
                INNER JOIN pre_race_instance pri ON pri.race_instance_uid = ri.race_instance_uid
                INNER JOIN pre_race_instance_comments pric ON pric.race_instance_uid = ri.race_instance_uid
                LEFT JOIN going_type gt ON gt.going_type_code = ri.going_type_code
                LEFT JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid AND ri.race_group_uid != 0
            WHERE ri.race_instance_uid = :raceId
                AND CASE
                        WHEN pri.race_status_code = " . Constants::RACE_STATUS_RESULTS . " THEN '-1' ELSE
                            CASE
                                WHEN pri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                                    THEN '0' ELSE pri.race_status_code
                            END
                    END = (
                        SELECT MIN(
                            CASE
                                WHEN ipri.race_status_code = " . Constants::RACE_STATUS_RESULTS . " THEN '-1' ELSE
                                    CASE
                                        WHEN ipri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                                            THEN '0' ELSE ipri.race_status_code
                                    END
                            END
                        )
                        FROM pre_race_instance ipri
                        WHERE ipri.race_instance_uid = ri.race_instance_uid
                        GROUP BY ipri.race_instance_uid
                    )
        ");

        $builder->setParam('raceId', $raceId);
        $builder->setRow(new RaceRow());

        $rtn = $this->queryBuilder($builder);

        return $rtn->getFirst() ?: null;
    }

    /**
     * @param int $raceId
     *
     * @return array
     */
    public function getRunners(int $raceId): array
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
            SELECT
                h.horse_uid,
                horse_name = h.style_name,
                h.country_origin_code,
                phr.saddle_cloth_no,
                phr.draw,
                phr.rp_postmark,
                non_runner = CASE WHEN phr.non_runner = 'Y' THEN 1 ELSE 0 END,
                ho.owner_uid,
                phr.rp_owner_choice
            FROM
                race_instance ri
                INNER JOIN pre_horse_race phr ON phr.race_instance_uid = ri.race_instance_uid
                INNER JOIN horse h ON h.horse_uid = phr.horse_uid
                LEFT JOIN horse_owner ho ON ho.horse_uid = h.horse_uid
                    AND ho.owner_change_date = isnull(
                            (
                                SELECT MIN(hoi.owner_change_date)
                                FROM horse_owner hoi
                                WHERE hoi.horse_uid = ho.horse_uid AND hoi.owner_change_date >= ri.race_datetime
                            ),
                            CONVERT(DATETIME, '1 jan 1900')
                    )
            WHERE
                ri.race_instance_uid = :raceId
                AND phr.race_status_code = (
                    CASE
                        WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                        THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                        ELSE ri.race_status_code
                    END
                )
            ORDER BY ri.race_datetime, phr.saddle_cloth_no, h.style_name
        ");

        $builder->setParam('raceId', $raceId);

        $builder->build();
        $builder->setRow(new HorseRow());

        $collection = $this->queryBuilder($builder);

        return $collection->toArrayWithRows('horse_uid');
    }

    /**
     * @param int    $raceId
     * @param string $countryCode
     *
     * @return array|null
     */
    public function getSelections(int $raceId, string $countryCode): ?array
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
            SELECT DISTINCT
                np.newspaper_name,
                np.newspaper_uid,
                np.sort_order,
                h.horse_uid,
                horse_name = h.style_name
            FROM newspapers np
                INNER JOIN tipster_selection ts ON np.newspaper_uid = ts.newspaper_uid
                INNER JOIN horse h ON h.horse_uid = ts.horse_uid
            WHERE ts.race_instance_uid = :raceId
                AND np.sort_order IS NOT NULL
                /*{WHERE}*/
            ORDER BY np.sort_order, np.newspaper_uid
        ");

        $builder->setParam('raceId', $raceId);

        switch ($countryCode) {
            case 'GB':
                $builder->where('
                    AND (
                        np.newspaper_uid BETWEEN 1 AND 10
                        OR np.newspaper_uid IN (12, 40, 57, 70)
                        OR np.newspaper_uid BETWEEN 14 AND 19
                    )
                ');
                break;
            case 'IRE':
                $builder->where('
                    AND (
                        np.newspaper_uid BETWEEN 90 AND 99
                        OR np.newspaper_uid IN (1, 3, 4, 22, 78, 100, 106)
                    )
                ');
                break;
            default:
                return null;
        }

        $builder->build();

        return $this->queryBuilder($builder)->toArrayWithRows();
    }

    /**
     * @param int    $raceId
     * @param string $raceDate
     *
     * @return string|null
     * @throws ResultsetException
     */
    public function getKeyStats(int $raceId, string $raceDate): ?string
    {
        $raceDate = (new \DateTime($raceDate))->format('Y-m-d');

        $storiesDB = $this->getDI()->get('selectors')->getDb()->getStoriesDb();
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT s.story
            FROM {$storiesDB}..story s
                INNER JOIN {$storiesDB}..story_indicies si ON si.story_uid = s.story_uid
                INNER JOIN {$storiesDB}..story_indicies si2 ON si.story_uid = s.story_uid
            WHERE s.category_uid = 55
                AND s.subcategory_uid = 327
                AND si.db_uid = :raceId
                AND si.object_uid = 10
                AND si2.object_uid = 20
                AND si2.tag_ref = :raceDate
        ");

        $builder->setParam('raceId', $raceId);
        $builder->setParam('raceDate', $raceDate);

        $rtn = $this->queryBuilder($builder)->getFirst();

        return $rtn ? $rtn->story : null;
    }
}
