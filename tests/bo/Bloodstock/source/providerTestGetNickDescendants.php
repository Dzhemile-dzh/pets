<?php

use Api\Input\Request\Horses\Bloodstock\Stallion as Request;

return [
    [
        new Request\NickDescendants([43127, 'total-prize'], ['stallionId' => 653884]),
        array(
            0 => \Api\Row\Bloodstock\Stallion\Nick::createFromArray(
                array(
                    'horse_uid' => 859459,
                    'style_name' => 'Vodka Wells',
                    'runs' => 20,
                    'wins' => 2,
                    'win_prize_money' => 11696.4,
                    'total_money' => 20203.650000000001,
                )
            ),
            1 => \Api\Row\Bloodstock\Stallion\Nick::createFromArray(
                array(
                    'horse_uid' => 870205,
                    'style_name' => 'Wells De Lune',
                    'runs' => 5,
                    'wins' => 1,
                    'win_prize_money' => 3898.8000000000002,
                    'total_money' => 3898.8000000000002,
                )
            ),
        )
    ],
    [
        new Request\NickDescendants([301128, 'a-z'], ['stallionId' => 58025]),
        array(
            0 => \Api\Row\Bloodstock\Stallion\Nick::createFromArray(
                array(
                    'horse_uid' => 463607,
                    'style_name' => 'Bombay Mix',
                    'runs' => 21,
                    'wins' => 3,
                    'win_prize_money' => 8660.5499999999993,
                    'total_money' => 10021.93,
                )
            ),
            1 => \Api\Row\Bloodstock\Stallion\Nick::createFromArray(
                array(
                    'horse_uid' => 519052,
                    'style_name' => 'Diamond Rachael',
                    'runs' => 29,
                    'wins' => 4,
                    'win_prize_money' => 12222.5,
                    'total_money' => 15644.5,
                )
            ),
            2 => \Api\Row\Bloodstock\Stallion\Nick::createFromArray(
                array(
                    'horse_uid' => 475575,
                    'style_name' => 'Pass The Rest',
                    'runs' => 23,
                    'wins' => 2,
                    'win_prize_money' => 9556,
                    'total_money' => 14040,
                )
            ),
        )
    ]
];
