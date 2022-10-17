<?php

return [
    [
        new \Api\Input\Request\Horses\Bloodstock\Stallion\ProgenyEntries(
            [
                'jumps'
            ],
            [
                'stallionId' => 531769
            ]
        ),
        [
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'race_instance_uid' => 642821,
                    'race_datetime' => 'Mar 15 2016  1:30PM',
                    'distance_yard' => 3607,
                    'race_instance_title' => 'Sky Bet Supreme Novices\' Hurdle (Grade 1)',
                    'race_status_code' => '4',
                    'prize_sterling' => null,
                    'course_name' => 'CHELTENHAM',
                    'course_uid' => 11,
                    'course_style_name' => 'Cheltenham',
                    'no_of_runners' => 64,
                    'style_name' => 'Supasundae',
                    'country_origin_code' => 'GB',
                    'horse_uid' => 854911,
                    'dam_style_name' => 'Distinctive Look',
                    'dam_country_origin_code' => 'IRE',
                    'dam_horse_uid' => 642069,
                    'actual_race_class' => '1',
                    'horse_age' => 6,
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'race_instance_uid' => 643856,
                    'race_datetime' => 'Mar 16 2016  2:50PM',
                    'distance_yard' => 4646,
                    'race_instance_title' => 'Coral Cup (A Handicap Hurdle) (Grade 3)',
                    'race_status_code' => '4',
                    'prize_sterling' => null,
                    'course_name' => 'CHELTENHAM',
                    'course_uid' => 11,
                    'course_style_name' => 'Cheltenham',
                    'no_of_runners' => 154,
                    'style_name' => 'Shelford',
                    'country_origin_code' => 'IRE',
                    'horse_uid' => 773285,
                    'dam_style_name' => 'Lyrical',
                    'dam_country_origin_code' => 'GB',
                    'dam_horse_uid' => 442963,
                    'actual_race_class' => '1',
                    'horse_age' => 7,
                ]
            )
        ]
    ]
];
