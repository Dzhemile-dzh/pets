<?php

namespace Api\DataProvider\Bo\LookupTable;

/**
 * @package Api\DataProvider\Bo\LookupTable
 */
class CourseList extends \Phalcon\Mvc\DataProvider
{
    /**
     * @return array
     */
    public function getData()
    {
        $sql = "
            SELECT
                course_uid,
                style_name,
                country_code,
                course_code,
                course_type_code,
                rp_abbrev_3
            FROM
                course
            ORDER BY course_name
        ";

        $result = $this->query($sql);
        return $result->toArrayWithRows();
    }
}
