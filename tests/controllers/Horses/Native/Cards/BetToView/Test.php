<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Native\Cards\BetToView;

use UnitTestsComponents\ApiRouteTest\Xml as ApiRouteTestPrototype;

/**
 * @package Tests\Controllers\Horses\Native\Cards\BetToView
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/native/cards/703330/bet-to-view';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\Native\Cards\BetToView:32 ->getData()
            '02cd54e51f793a9e38fa46abe54f2132' => [
                [
                    'perform_race_uid' => 1401333,
                ],
            ],
        ];
    }
}
