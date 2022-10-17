<?php

namespace Models\Bo\Results;

use Phalcon\Mvc\Model;
use \Api\Constants\Horses as Constants;
use Phalcon\Db\Sql\Builder;

/**
 * Class Course
 *
 * @package Models\Bo\Results
 */
class Course extends \Models\Course
{
    /**
     * @param bool $returnP2P
     * @return array
     */
    public function getCourses($returnP2P)
    {
        $builder = new Builder();

        $builder->setSqlTemplate(
            "
            SELECT
                c.course_uid,
                c.course_name,
                cy.country_desc,
                c.country_code,
                c.style_name course_style_name,
                (CASE WHEN c.country_code IN ('GB', 'IRE') THEN 1 ELSE 99 END) sort_order
            FROM 
                course c,
                country cy
            WHERE 
                cy.country_code = c.country_code
                /*{WHERE}*/
            ORDER BY sort_order, c.country_code, c.course_name"
        );

        if (!$returnP2P) {
            $builder->where(" AND c.course_type_code != '" . Constants::COURSE_TYPE_P2P_CODE . "'");
        }

        $builder->build();

        $res = $this->getReadConnection()->query($builder->getSql());

        $resultCollection = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return $resultCollection->getGroupedResult(
            [
                'country_code',
                'country_desc',
                'courses' => [
                    'course_uid',
                    'course_name',
                    'course_style_name',
                    'country_code'
                ]
            ]
        );
    }
}
