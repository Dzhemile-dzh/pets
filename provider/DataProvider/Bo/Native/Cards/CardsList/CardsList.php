<?php

declare(strict_types=1);

namespace Api\DataProvider\Bo\Native\Cards\CardsList;

use Api\DataProvider\HorsesDataProvider;
use Api\Input\Request\Horses\Native\Cards\CardsList as Request;
use Phalcon\Db\Sql\Builder;
use Api\Constants\Horses as Constants;

/**
 * @package Api\DataProvider\Bo\Native\Cards
 */
class CardsList extends HorsesDataProvider
{
    /**
     * @param string $raceDate
     *
     * @return array
     */
    public function getData($raceDate): array
    {
        $builder = new Builder();
        // We need to sort list alphabetical by meetings and by race_datetime asc by races
        // GB and IRE meetings should be first and ARO meetings should be last
        // To implement this requirement position fields is used
        $builder->setSqlTemplate("
                SELECT * FROM (
                    SELECT DISTINCT
                        CASE WHEN c2.course_uid IS NOT NULL THEN c2.course_uid ELSE c.course_uid END course_id,
                        CASE WHEN c2.style_name IS NOT NULL THEN c2.style_name ELSE c.style_name END course_name,
                        c.country_code course_country,
                        CASE WHEN c.country_code IN ('" . Constants::COUNTRY_GB . "','" . Constants::COUNTRY_IRE . "') THEN 1
                             WHEN c.country_code IN ('" . Constants::COUNTRY_ARO . "') THEN 3 
                             ELSE 2 END
                        AS position,
                        CASE WHEN c.country_code IN ('" . Constants::COUNTRY_GB . "','" . Constants::COUNTRY_IRE . "') THEN 1
                             ELSE 2 END
                        AS rp_position,
                        
                        rp_meeting_order = null,
                        
                        ri.race_instance_uid race_id,
                        ri.race_datetime race_date,
                        ri.race_instance_title race_title,
                        ri.race_type_code race_type,
                        ri.distance_yard distance,
                        ri.race_status_code race_status_code,
                        ri.pool_prize_sterling,
                        sel.race_selection_type scoop,
                        
                        CASE WHEN pric.rp_tv_text NOT IN ('BBC1','BBC2', 'BBCi', 'CH4')
                        THEN pric.rp_tv_text ELSE '' END satelite_tv_txt,
                        CASE WHEN pric.rp_tv_text IN ('BBC1','BBC2','BBCi','CH4')
                        THEN pric.rp_tv_text ELSE '' END terrestrial_tv_txt,
                        CASE WHEN rg.race_group_uid = 0 THEN NULL ELSE rg.race_group_desc END AS race_group,
                        rg.race_group_code race_group_symbol,
                        rg.race_group_uid,
                        pr.perform_race_uid perform_race,
                        pr.isATR is_atr,
                        count_runners = (
                            SELECT COUNT(1)
                            FROM pre_horse_race phr2
                            WHERE phr2.race_instance_uid = ri.race_instance_uid
                            AND phr2.race_status_code = CASE WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . " THEN " . Constants::RACE_STATUS_OVERNIGHT . " ELSE ri.race_status_code END
                        ),
                        (CASE WHEN clt.hours_difference IS NULL THEN 0 ELSE clt.hours_difference END) hours_difference,
                        liveCommentary = CASE WHEN LEN(pric.rp_verdict) > 0 THEN 1 ELSE 0 END,
                        tvText = CASE 
                               WHEN pric.rp_tv_text = 'B1' THEN 'BBC1' 
                               WHEN pric.rp_tv_text = 'B2' THEN 'BBC2'
                               WHEN pric.rp_tv_text = 'C4' THEN 'CH4'
                               ELSE pric.rp_tv_text END,
                        (
                            SELECT DISTINCT ral.race_attrib_desc
                            FROM race_attrib_join raj, race_attrib_lookup ral
                            WHERE ri.race_instance_uid = raj.race_instance_uid
                            AND raj.race_attrib_uid = ral.race_attrib_uid
                            AND ral.race_attrib_code = (
                                CASE WHEN c.country_code = 'GB'
                                    THEN 'Class_subset'
                                    ELSE 'Class'
                                END
                            )
                        ) AS race_class,
                        rg.race_group_desc,
                        tvChannels = null
                    FROM course c
                    JOIN race_instance ri
                        ON ri.course_uid = c.course_uid
                    JOIN pre_race_instance pri
                        ON ri.race_instance_uid = pri.race_instance_uid
                            AND pri.race_status_code =
                                 (CASE WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                                    THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                                    ELSE ri.race_status_code
                                END)
                    LEFT JOIN course c2 
                        ON c.country_code = c2.country_code
                        AND c.rp_abbrev_3 = c2.rp_abbrev_3
                        AND c2.course_name NOT LIKE '%(A.W)%'
                        AND c2.course_uid IN (
                            SELECT course_uid
                            FROM race_instance ri2 
                            WHERE ri2.race_datetime BETWEEN :dayStart AND :dayEnd)
                    LEFT JOIN race_group rg 
                        ON rg.race_group_uid = ri.race_group_uid
                    LEFT JOIN race_selection sel
                        ON ri.race_instance_uid = sel.race_instance_uid
                    LEFT JOIN pre_race_instance_comments pric 
                        ON pric.race_instance_uid = ri.race_instance_uid
                    LEFT JOIN perform_race pr 
                        ON pr.race_instance_uid = ri.race_instance_uid
                    LEFT JOIN perform_atr pa 
                        ON pa.race_instance_uid = ri.race_instance_uid
                    LEFT JOIN course_local_time clt
                        ON clt.course_uid = c.course_uid AND ri.race_datetime BETWEEN clt.date_from AND clt.date_to
                    WHERE 
                        ri.race_type_code != 'P'
                        AND c.course_name NOT LIKE ('%P-T-P%')
                        AND ri.race_datetime BETWEEN :dayStartWide AND :dayEndWide
                        AND NOT EXISTS (
                            SELECT 1
                            FROM race_attrib_join raj
                            WHERE
                                raj.race_instance_uid = ri.race_instance_uid
                                AND raj.race_attrib_uid = 432
                        )
                ) as main
                WHERE 
                    datediff(DAY, dateadd(MINUTE, isnull(main.hours_difference, 0)  * 60, main.race_date) , :meetingDate) = 0
                    OR
                    datediff(DAY, main.race_date, :meetingDate) = 0                   
                ORDER BY main.position, main.course_name, main.race_date ASC
        ");

        $builder
            ->setParam('dayStartWide', date("Y-m-d H:i:s", strtotime($raceDate . " 00:00:00 -12 hours")))
            ->setParam('dayEndWide', date("Y-m-d H:i:s", strtotime($raceDate . " 23:59:59 +12 hours")))
            ->setParam('dayStart', $raceDate . ' 00:00:00')
            ->setParam('dayEnd', $raceDate . ' 23:59:59')
            ->setParam('meetingDate', $raceDate);

        $data = $this->queryBuilder($builder);

        $rtn =  $data->getGroupedResult([
            'course_id',
            'course_name',
            'course_country',
            'rp_position',
            'rp_meeting_order',
            'races' => [
                'race_id' => 'race_id',
                'race_date' => 'race_date',
                'race_title' => 'race_title',
                'race_type' => 'race_type',
                'distance' => 'distance',
                'race_status_code' => 'race_status_code',
                'scoop' => 'scoop',
                'satelite_tv_txt' => 'satelite_tv_txt',
                'terrestrial_tv_txt' => 'terrestrial_tv_txt',
                'race_group' => 'race_group',
                'race_group_symbol' => 'race_group_symbol',
                'race_group_uid' => 'race_group_uid',
                'perform_race' => 'perform_race',
                'is_atr' => 'is_atr',
                'count_runners' => 'count_runners',
                'hours_difference' => 'hours_difference',
                'liveCommentary' => 'liveCommentary',
                'tvText' => 'tvText',
                'race_class' => 'race_class',
                'race_group_desc' => 'race_group_desc',
                'tvChannels' => 'tvChannels',
                'pool_prize_sterling' => 'pool_prize_sterling'
            ]
        ]);

        return $rtn;
    }
}
