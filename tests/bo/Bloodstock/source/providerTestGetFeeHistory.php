<?php

use Api\Input\Request\Horses\Bloodstock\Stallion as Request;

return [
    [
        new Request\FeeHistory([], ['stallionId' => 7983]),
        [
            \Api\Row\Bloodstock\Stallion\FeeHistory::createFromArray(
                array(
                    'nomination_fee' => 2500,
                    'stud_fee_condition' => null,
                    'stud_name' => 'Side Hill Stud',
                    'country_code' => 'GB',
                    'country_desc' => 'Great Britain',
                    'cur_code' => 'GBP',
                    'year' => 2001,
                    'exchange_rate' => 1,
                )
            ),
            \Api\Row\Bloodstock\Stallion\FeeHistory::createFromArray(
                array(
                    'nomination_fee' => 7500,
                    'stud_fee_condition' => null,
                    'stud_name' => null,
                    'country_code' => null,
                    'country_desc' => null,
                    'cur_code' => 'GBP',
                    'year' => 2000,
                    'exchange_rate' => 1,
                )
            ),
            \Api\Row\Bloodstock\Stallion\FeeHistory::createFromArray(
                array(
                    'nomination_fee' => 10000,
                    'stud_fee_condition' => null,
                    'stud_name' => null,
                    'country_code' => null,
                    'country_desc' => null,
                    'cur_code' => 'GBP',
                    'year' => 1999,
                    'exchange_rate' => 1,
                )
            ),
            \Api\Row\Bloodstock\Stallion\FeeHistory::createFromArray(
                array(
                    'nomination_fee' => 17500,
                    'stud_fee_condition' => null,
                    'stud_name' => null,
                    'country_code' => null,
                    'country_desc' => null,
                    'cur_code' => 'GBP',
                    'year' => 1998,
                    'exchange_rate' => 1,
                )
            ),
            \Api\Row\Bloodstock\Stallion\FeeHistory::createFromArray(
                array(
                    'nomination_fee' => 17500,
                    'stud_fee_condition' => null,
                    'stud_name' => null,
                    'country_code' => null,
                    'country_desc' => null,
                    'cur_code' => 'GBP',
                    'year' => 1997,
                    'exchange_rate' => 1,
                )
            ),
            \Api\Row\Bloodstock\Stallion\FeeHistory::createFromArray(
                array(
                    'nomination_fee' => 12500,
                    'stud_fee_condition' => null,
                    'stud_name' => null,
                    'country_code' => null,
                    'country_desc' => null,
                    'cur_code' => 'GBP',
                    'year' => 1996,
                    'exchange_rate' => 1,
                )
            ),
        ],
    ],
    [
        new Request\FeeHistory([], ['stallionId' => 6501]),
        [
            \Api\Row\Bloodstock\Stallion\FeeHistory::createFromArray(
                array(
                    'nomination_fee' => 0,
                    'stud_fee_condition' => 'poa',
                    'stud_name' => 'Garryrichard Stud',
                    'country_code' => 'IRE',
                    'country_desc' => 'Ireland',
                    'cur_code' => 'EUR',
                    'year' => 2007,
                    'exchange_rate' => 1.48,
                )
            ),
            \Api\Row\Bloodstock\Stallion\FeeHistory::createFromArray(
                array(
                    'nomination_fee' => 1250,
                    'stud_fee_condition' => null,
                    'stud_name' => 'Garryrichard Stud',
                    'country_code' => 'IRE',
                    'country_desc' => 'Ireland',
                    'cur_code' => 'EUR',
                    'year' => 2006,
                    'exchange_rate' => 1.45,
                )
            ),
            \Api\Row\Bloodstock\Stallion\FeeHistory::createFromArray(
                array(
                    'nomination_fee' => 0,
                    'stud_fee_condition' => 'poa',
                    'stud_name' => 'Garryrichard Stud',
                    'country_code' => 'IRE',
                    'country_desc' => 'Ireland',
                    'cur_code' => 'EUR',
                    'year' => 2005,
                    'exchange_rate' => 1.4099999999999999,
                )
            ),
            \Api\Row\Bloodstock\Stallion\FeeHistory::createFromArray(
                array(
                    'nomination_fee' => 0,
                    'stud_fee_condition' => 'poa',
                    'stud_name' => 'Sunnyhill Stud',
                    'country_code' => 'IRE',
                    'country_desc' => 'Ireland',
                    'cur_code' => 'EUR',
                    'year' => 2004,
                    'exchange_rate' => 1.4199999999999999,
                )
            ),
            \Api\Row\Bloodstock\Stallion\FeeHistory::createFromArray(
                array(
                    'nomination_fee' => 0,
                    'stud_fee_condition' => 'poa',
                    'stud_name' => 'Sunnyhill Stud',
                    'country_code' => 'IRE',
                    'country_desc' => 'Ireland',
                    'cur_code' => 'EUR',
                    'year' => 2003,
                    'exchange_rate' => 1.54,
                )
            ),
            \Api\Row\Bloodstock\Stallion\FeeHistory::createFromArray(
                array(
                    'nomination_fee' => 0,
                    'stud_fee_condition' => 'poa',
                    'stud_name' => 'Sunnyhill Stud',
                    'country_code' => 'IRE',
                    'country_desc' => 'Ireland',
                    'cur_code' => 'EUR',
                    'year' => 2002,
                    'exchange_rate' => 1.6299999999999999,
                )
            ),
            \Api\Row\Bloodstock\Stallion\FeeHistory::createFromArray(
                array(
                    'nomination_fee' => 0,
                    'stud_fee_condition' => 'poa',
                    'stud_name' => 'Sunnyhill Stud',
                    'country_code' => 'IRE',
                    'country_desc' => 'Ireland',
                    'cur_code' => 'IRG',
                    'year' => 2001,
                    'exchange_rate' => 1.1809499999999999,
                )
            ),
        ]
    ],
];
