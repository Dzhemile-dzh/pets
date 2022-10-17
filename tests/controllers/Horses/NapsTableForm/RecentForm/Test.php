<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\NapsTableForm\RecentForm;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\NapsTableForm\RecentForm
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/naps-table/recent-form';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData():array
    {
        return [
            //Models/Bo/NapsTableForm/RecentForm.php:4250->getNapsTableForm()
            '01170503f4819c4a9c8e23b2fff36ac9' => [
                    [
                        "horse_uid"=> 2701456,
                        "horse_style_name"=> "Ventura Flame",
                        "newspaper"=> "The Sun",
                        "tipster"=> "Templegate",
                        "level_stake"=> 41.883,
                        "recent_form"=> null
                    ],
                    [
                        "horse_uid"=> 3406860,
                        "horse_style_name"=> "Marsden Cross",
                        "newspaper"=> "The Irish Field",
                        "tipster"=> "Rory Delargy",
                        "level_stake"=> 18,
                        "recent_form"=> null
                    ],
                    [
                        "horse_uid"=> 2644676,
                        "horse_style_name"=> "Imperial Command",
                        "newspaper"=> "Sunday Telegraph",
                        "tipster"=> "Whistler",
                        "level_stake"=> 9.5,
                        "recent_form"=> null
                    ],
                    [
                        "horse_uid"=> 2219563,
                        "horse_style_name"=> "Aplomb",
                        "newspaper"=> "The Scotsman",
                        "tipster"=> "Glendale",
                        "level_stake"=> 9.075,
                        "recent_form"=> null
                    ],
                    [
                        "horse_uid"=> 2901151,
                        "horse_style_name"=> "Seventeen O Four",
                        "newspaper"=> "Daily Record",
                        "tipster"=> "Garry Owen",
                        "level_stake"=> 5.5,
                        "recent_form"=> null
                    ],
                    [
                        "horse_uid"=> 2838228,
                        "horse_style_name"=> "Grey Fox",
                        "newspaper"=> "Racing TV",
                        "tipster"=> "The Score",
                        "level_stake"=> 4.833,
                        "recent_form"=> null
                    ]
                ],
            ];
    }
}