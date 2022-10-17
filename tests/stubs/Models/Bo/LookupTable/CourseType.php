<?php

namespace Tests\Stubs\Models\Bo\LookupTable;

class CourseType extends \Tests\Stubs\Models\CourseType
{

    /**
     * @return array
     */
    public function getCourseTypeTable()
    {
        return [
            "B" => \Phalcon\Mvc\Model\Row\General::createFromArray([
                "course_type_code"=> "B",
                "course_type_desc"=> "Flat & Jump"
            ]),
            "F" => \Phalcon\Mvc\Model\Row\General::createFromArray([
                "course_type_code"=> "F",
                "course_type_desc"=> "Flat"
            ]),
            "J" => \Phalcon\Mvc\Model\Row\General::createFromArray([
                "course_type_code"=> "J",
                "course_type_desc"=> "Jump"
            ]),
            "P" => \Phalcon\Mvc\Model\Row\General::createFromArray([
                "course_type_code"=> "P",
                "course_type_desc"=> "Point-to-point"
            ]),
            "X" => \Phalcon\Mvc\Model\Row\General::createFromArray([
                "course_type_code"=> "X",
                "course_type_desc"=> "All-Weather"
            ])
        ];
    }
}
