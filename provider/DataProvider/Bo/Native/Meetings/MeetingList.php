<?php

namespace Api\DataProvider\Bo\Native\Meetings;

use Phalcon\Mvc\DataProvider;
use Api\Input\Request\HorsesRequest as Request;
use Phalcon\Db\Sql\Builder;
use Api\Constants\Horses as Constants;

/**
 * Class MeetingList
 *
 * @package Api\DataProvider\Bo\Native\Meetings
 */
class MeetingList extends DataProvider
{
    /**
     * @param Request $request
     *
     * @return array|null
     */
    public function getListByDate(Request $request): ?array
    {
        $raceDate = $request->getMeetingDate();

        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                c.course_uid,
                course_name = c.style_name,
                course_country = c.country_code
            FROM course c
             WHERE c.country_code IN (:country)
                AND c.course_type_code != " . Constants::RACE_TYPE_P2P . "
                AND EXISTS (
                    SELECT 1
                    FROM race_instance ri
                    WHERE ri.course_uid = c.course_uid
                        AND ri.race_datetime BETWEEN :startDate AND :endDate
                    )
            ORDER BY
                c.style_name
        ");
        $builder
            ->setParam('startDate', date("Y-m-d H:i:s", strtotime($raceDate . " 00:01:00")))
            ->setParam('endDate', date("Y-m-d H:i:s", strtotime($raceDate . " 23:59:59")))
            ->setParam('country', [Constants::COUNTRY_GB, Constants::COUNTRY_IRE]);

        $builder->build();

        $data = $this->query(
            $builder->getSql(),
            $builder->getParams()
        );

        return $data->count() > 0 ? $data->toArrayWithRows() : null;
    }
}
