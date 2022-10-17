<?php

namespace Tests\Stubs\Models\Bo\Results;

class Courses extends \Tests\Stubs\Models\Course
{

    public function getCourses()
    {
        $data = [
            (Object)[
                "country_code" => "GB ",
                "country_desc" => "Great Britain",
                "courses" => [
                    (Object)[
                        "course_uid" => 32,
                        "course_name" => "AINTREE",
                        "course_style_name" => "Aintree",
                    ],
                    (Object)[
                        "course_uid" => 2,
                        "course_name" => "ASCOT",
                        "course_style_name" => "Ascot",
                    ],
                ]
            ],
            (Object)[
                "country_code" => "IRE",
                "country_desc" => "Ireland",
                "courses" => [
                    (Object)[
                        "course_uid" => 175,
                        "course_name" => "BALLINROBE",
                        "course_style_name" => "Ballinrobe",
                    ],
                    (Object)[
                        "course_uid" => 176,
                        "course_name" => "BELLEWSTOWN",
                        "course_style_name" => "Bellewstown",
                    ],
                ]
            ],

        ];
        return $data;
    }
}
