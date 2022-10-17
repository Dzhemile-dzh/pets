<?php

namespace Tests\Stubs\Models\Bo\DrawAnalyser;

class RaceInstance extends \Tests\Stubs\Models\RaceInstance
{
    public function getRace($raceId)
    {
        $data = [
            599203 =>  \Api\Row\RaceInstance::createFromArray([
                'race_instance_uid' => 599203,
                'race_instance_title' => 'Irish Stallion Farms European Breeders Fund Maiden',
                'race_datetime' => 'Apr  6 2014  1:55PM',
                'distance_yard' => 1100,
                'no_of_runners' => 8,
                'course_uid' => 596,
                'course_name' => 'SOME COURSE',
                'going_type_code' => 'HY',
                'going_type_desc' => 'Heavy',
                'significance_text_summary' => 'STRONG LOW',
            ]),
            599206 => \Api\Row\RaceInstance::createFromArray([
                'race_instance_uid' => 599206,
                'race_instance_title' => 'Mallow Handicap',
                'race_datetime' => 'Apr  6 2014  3:30PM',
                'distance_yard' => 1540,
                'no_of_runners' => 8,
                'course_uid' => 596,
                'course_name' => 'SOME COURSE',
                'going_type_code' => 'HY',
                'going_type_desc' => 'Heavy',
                'significance_text_summary' => 'STRONG LOW',
            ]),
            599210 => \Api\Row\RaceInstance::createFromArray([
                'race_instance_uid' => 599210,
                'race_instance_title' => 'Blackwater Fillies Maiden',
                'race_datetime' => 'Apr  6 2014  5:40PM',
                'distance_yard' => 2250,
                'no_of_runners' => 8,
                'course_uid' => 596,
                'course_name' => 'SOME COURSE',
                'going_type_code' => 'HY',
                'going_type_desc' => 'Heavy',
                'significance_text_summary' => 'STRONG LOW',
            ])
        ];

        return isset($data[$raceId]) ? $data[$raceId] : null;
    }
}
