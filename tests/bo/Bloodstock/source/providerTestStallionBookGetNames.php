<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 7/1/2016
 * Time: 11:21 AM
 */

use Api\Input\Request\Horses\Bloodstock\StallionBook\Names as Request;

return [
    [
        new Request([], [
            'type' => 'active'
        ]),
        (Object)[
            'stallion_names' => [
                'Milanais',
                'Cockney Rebel',
                'Walk In The Park',
                'Acclamation',
                'Air Chief Marshal',
            ],
            'sire_names' => [
                'Dyhim Diamond',
                'Val Royal',
                'Montjeu',
                'Royal Applause',
                'Danehill Dancer',
            ],
            'stud_farms' => [
                'Haras de Lonray',
                'Haras Du Thenney',
                'Grange Stud (IRE)',
                'Rathbarry Stud',
                'Haras De La Cauviniere',
            ],
            'sire_line' => [
                'Night Shift',
                'Royal Academy',
                'Sadler\'s Wells',
                'Waajib',
                'Danehill'
            ]
        ]
    ]
];
