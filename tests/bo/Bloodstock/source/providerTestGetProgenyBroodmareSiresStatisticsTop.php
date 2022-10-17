<?php

return [
    [
        new \Api\Input\Request\Horses\Bloodstock\Stallion\ProgenyBroodmareSiresStatisticsTop(
            [1988],
            ['stallionId' => 531769]
        ),
        array (
            0 => \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                'horse_style_name' => 'Frankel',
                'horse_uid' => 763453,
                'dam_sire_uid' => 42373,
                'dam_sire_style_name' => 'Danehill',
                'sire_uid' => 42373,
                'sire_style_name' => 'Danehill',
                'rp_postmark' => 143,
                'runs' => 12,
                'wins' => 12,
                'total_prize_money' => 2982864.0899999999,
            )),
            1 => \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                'horse_style_name' => 'Rip Van Winkle',
                'horse_uid' => 695691,
                'dam_sire_uid' => 500343,
                'dam_sire_style_name' => 'Stravinsky',
                'sire_uid' => 500343,
                'sire_style_name' => 'Stravinsky',
                'rp_postmark' => 132,
                'runs' => 11,
                'wins' => 4,
                'total_prize_money' => 1191759.02,
            )),
            2 => \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                'horse_style_name' => 'New Approach',
                'horse_uid' => 670119,
                'dam_sire_uid' => 300030,
                'dam_sire_style_name' => 'Ahonoora',
                'sire_uid' => 500343,
                'sire_style_name' => 'Stravinsky',
                'rp_postmark' => 131,
                'runs' => 10,
                'wins' => 7,
                'total_prize_money' => 1983270.72,
            ))
        )
    ]
];
