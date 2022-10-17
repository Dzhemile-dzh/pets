<?php

namespace Tests\Stubs\Models;

use \Phalcon\Mvc\Model\Row\General as GeneralRow;

class CourseDirections extends \Models\CourseDirections
{
    /**
     * @param array $courseIds
     *
     * @return array
     */
    public function getCourseDirectionsByCourseId(array $courseIds)
    {
        $data = [
            '15' => [
                15 => [
                    \Phalcon\Mvc\Model\Row\General::createFromArray([
                        "course_uid" => 15,
                        "direction_type_code" => "A",
                        "direction" => "Robin Hood Airport Doncaster Sheffield"

                    ]),
                    \Phalcon\Mvc\Model\Row\General::createFromArray([
                        "course_uid" => 15,
                        "direction_type_code" => "R",
                        "direction" => "E of town, off the A638 (M18 Jctn 3 & 4, A1M Jct36)"

                    ]),
                    \Phalcon\Mvc\Model\Row\General::createFromArray([
                        "course_uid" => 15,
                        "direction_type_code" => "T",
                        "direction" => "Doncaster Station (2.5 miles)."
                    ])
                ]
            ],
            '16' => [],
            '31' => [
                31 =>
                    [
                        0 =>
                            GeneralRow::createFromArray([
                                'course_uid' => 31,
                                'direction_type_code' => 'A',
                                'direction' => '10m, London (Gatwick)',
                            ]),
                        1 =>
                            GeneralRow::createFromArray([
                                'course_uid' => 31,
                                'direction_type_code' => 'R',
                                'direction' => 'SE of town on B2028 Edenbridge Road. M23(Jnct9), M25(Jnct6).',
                            ]),
                        2 =>
                            GeneralRow::createFromArray([
                                'course_uid' => 31,
                                'direction_type_code' => 'T',
                                'direction' => 'Adjoining Course, Lingfield Stn (from London Victoria).',
                            ]),
                    ],
            ],
            '34' => [
                34 =>
                    [
                        0 =>
                            GeneralRow::createFromArray([
                                'course_uid' => 34,
                                'direction_type_code' => 'R',
                                'direction' => '2m NW of town off A49 Shrewsbury road. N.B Roadworks on Ludlow by-pass may cause delays.',
                            ]),
                        1 =>
                            GeneralRow::createFromArray([
                                'course_uid' => 34,
                                'direction_type_code' => 'T',
                                'direction' => '2m, Ludlow Stn (Hereford-Shrewsbury line).',
                            ]),
                    ],
            ]
        ];

        return $data[implode(',', $courseIds)];
    }
}
