<?php

use Api\Input\Request\Horses\Bloodstock\Sales as Request;

return [
    [
        new Request\CompanyNames([], ['dateFrom' => '2016-05-23', 'dateTo' => '2016-05-30']),
        [
            0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    "sale_co_uid" => 43,
                    "sale_co_name" => "ADENA SPRINGS (OBS)"
                ]
            ),
            1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    "sale_co_uid" => 36,
                    "sale_co_name" => "ARQANA"
                ]
            ),
            2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    "sale_co_uid" => 25,
                    "sale_co_name" => "BADEN-BADEN"
                ]
            ),
            3 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    "sale_co_uid" => 31,
                    "sale_co_name" => "BARRETTS"
                ]
            ),
        ],
    ],
];
