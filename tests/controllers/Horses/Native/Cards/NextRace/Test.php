<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Native\Cards\NextRace;

use UnitTestsComponents\ApiRouteTest\Xml as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\Native\Cards\Predictor\Race
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/native/cards/2018-06-19/next-race';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\Native\Cards\NextRace\Data:42 ->getData()
            '193128361fe1df79469422c955cbf9bb' => [
                [
                    'race_instance_uid' => 705538,
                    'race_datetime' => '2018-06-19 11:55:00',
                ],
            ],
        ];
    }
}
