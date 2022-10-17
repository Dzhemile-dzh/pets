<?php

namespace Models\Bo\LookupTable;

class CourseType extends \Models\CourseType
{
    /**
     * @return array
     */
    public function getCourseTypeTable()
    {
        $res = $this->getReadConnection()->query(
            'SELECT
                course_type_code,
                course_type_desc
            FROM course_type'
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(null, new \Phalcon\Mvc\Model\Row(), $res);

        return $result->toArrayWithRows('course_type_code');
    }
}
