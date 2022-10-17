<?php

namespace Tests\Controllers\Horses\RaceCards;

use Api\Input\Request\Horses\RaceCards\PastWinners as Request;
use Controllers\Horses\RaceCards as Controller;
use Tests\Stubs\Data\Horses\RaceCards\PastWinners as Stubs;
use UnitTestsComponents\CommonTestCase;
use UnitTestsComponents\Stubs\StubDataInterface;

/**
 * Class PastWinnersTest
 * @package Tests\Controllers\Horses\RaceCards
 */
class PastWinnersTest extends CommonTestCase
{
    /**
     * @param Request $request
     * @param StubDataInterface $stubData
     * @throws \Exception
     * @dataProvider dataProviderActionGetPastWinners
     */
    public function testActionGetPastWinners(Request $request, StubDataInterface $stubData)
    {
        $this->initPseudoPdo($stubData);

        $ctrl = new Controller();
        $ctrl->actionGetPastWinners($request);
        $this->assertControllerResultEqualsJson($ctrl, $stubData);
    }

    /**
     * @return array
     */
    public function dataProviderActionGetPastWinners()
    {
        return [
            [
                new Request([699011]),
                new Stubs\StubData()
            ],
        ];
    }
}
