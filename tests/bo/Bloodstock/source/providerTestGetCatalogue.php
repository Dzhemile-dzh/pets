<?php

use Api\Input\Request\Horses\Bloodstock\Sales\Catalogue;

return [
    [
        new Catalogue([2016], ['limitToDate' => 1]),
        [
            0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'venue_uid' => 3,
                    'sale_name' => 'Goffs Landrover NH Sale 2016',
                    'abbrev_name' => 'Goffs Landrover (stores)',
                    'sale_co' => 'GOFFS',
                    'sale_date' => 'Jun  7 2016 12:00AM',
                    'sale_end_date' => 'Jun  9 2016 12:00AM',
                    'total_lots' => 400,
                ]
            ),
            1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'venue_uid' => 3,
                    'sale_name' => 'Goffs Punchestown NH Sale 2016',
                    'abbrev_name' => 'Goffs Punchestown (h-i-t)',
                    'sale_co' => 'GOFFS',
                    'sale_date' => 'Apr 28 2016 12:00AM',
                    'sale_end_date' => 'Apr 28 2016 12:00AM',
                    'total_lots' => 355,
                ]
            ),
            2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'venue_uid' => 3,
                    'sale_name' => 'Goffs Punchestown NH Sale 2016',
                    'abbrev_name' => 'Goffs Punchestown (h-i-t)',
                    'sale_co' => 'GOFFS',
                    'sale_date' => 'Apr 25 2016 12:00AM',
                    'sale_end_date' => 'Apr 25 2016 12:00AM',
                    'total_lots' => 96,
                ]
            ),
            3 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'venue_uid' => 3,
                    'sale_name' => 'Goffs Punchestown NH Sale 2016',
                    'abbrev_name' => 'Goffs Punchestown (h-i-t)',
                    'sale_co' => 'GOFFS',
                    'sale_date' => 'Apr 22 2016 12:00AM',
                    'sale_end_date' => 'Apr 22 2016 12:00AM',
                    'total_lots' => 122,
                ]
            ),
            4 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'venue_uid' => 3,
                    'sale_name' => 'Goffs February Mixed Sale',
                    'abbrev_name' => 'Goffs Feb (mixed)',
                    'sale_co' => 'GOFFS',
                    'sale_date' => 'Feb 11 2016 12:00AM',
                    'sale_end_date' => 'Feb 11 2016 12:00AM',
                    'total_lots' => 286,
                ]
            ),
            5 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'venue_uid' => 3,
                    'sale_name' => 'Goffs February Mixed Sale',
                    'abbrev_name' => 'Goffs Feb (mixed)',
                    'sale_co' => 'GOFFS',
                    'sale_date' => 'Feb 10 2016 12:00AM',
                    'sale_end_date' => 'Feb 10 2016 12:00AM',
                    'total_lots' => 46,
                ]
            ),
            6 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'venue_uid' => 4,
                    'sale_name' => 'Tattersalls Ireland February N.H. Sale 2016',
                    'abbrev_name' => 'Tatts Ire Feb NH (mixed)',
                    'sale_co' => 'TATTERSALLS IRELAND',
                    'sale_date' => 'Feb  2 2016 12:00AM',
                    'sale_end_date' => 'Feb  2 2016 12:00AM',
                    'total_lots' => 150,
                ]
            ),
        ],
    ],
];
