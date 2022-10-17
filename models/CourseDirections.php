<?php

namespace Models;

class CourseDirections extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $course_uid;

    /**
     *
     * @var string
     */
    protected $direction_type_code;

    /**
     *
     * @var string
     */
    protected $direction;

    /**
     * @param array $courseIds
     *
     * @return array
     */
    public function getCourseDirectionsByCourseId(array $courseIds)
    {
        $sql = "SELECT *
                FROM course_directions
                WHERE course_uid IN (:courseIds:)";

        $res = $this->getReadConnection()->query(
            $sql,
            ['courseIds' => $courseIds]
        );

        $resultCollection = new \Phalcon\Mvc\Model\Resultset\General(null, new \Phalcon\Mvc\Model\Row\General(), $res);

        $resultArray = $resultCollection->toArrayWithRows('course_uid', null, true);

        return $resultArray;
    }
}
