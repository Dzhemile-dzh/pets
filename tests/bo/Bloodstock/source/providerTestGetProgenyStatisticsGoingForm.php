<?php
use Phalcon\Mvc\Model\Row\General;
use Api\Input\Request\Horses\Bloodstock\Stallion\ProgenyStatisticsGoingForm;

return [
    [
        new ProgenyStatisticsGoingForm([], ['stallionId' => 531769]),
        General::createFromArray([
            'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_group' => "good_to_firm",
                    'wins' => 331,
                    'runs' => 1999,
                    'win_percentage' => 17,
                    'impact_value' => 0.86,
                ]
            ),
            'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_group' => "good",
                    'wins' => 530,
                    'runs' => 3473,
                    'win_percentage' => 15,
                    'impact_value' => 0.44,
                ]
            ),
            'good_to_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_group' => "good_to_soft",
                    'wins' => 230,
                    'runs' => 1491,
                    'win_percentage' => 15,
                    'impact_value' => 1.01,
                ]
            ),
            'heavy_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_group' => "heavy_soft",
                    'wins' => 462,
                    'runs' => 2910,
                    'win_percentage' => 16,
                    'impact_value' => 0.55,
                ]
            ),
            'firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'going_group' => "firm",
                    'wins' => 35,
                    'runs' => 199,
                    'win_percentage' => 18,
                    'impact_value' => 9.11,
                ]
            ),
        ]),
    ],
];
