<?php

namespace Tests\Controllers\Horses\Results;

use Api\Input\Request\Horses\Results\PastWinners as Request;
use Controllers\Horses\Results as Controller;
use Tests\Stubs\Data\Horses\Results\PastWinners as Stubs;
use UnitTestsComponents\CommonTestCase;
use UnitTestsComponents\Stubs\StubDataInterface;

/**
 * Class PastWinnersTest
 * @package Tests\Controllers\Horses\Results
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
                new Request([], ['raceId' => 693122]),
                new Stubs\StubData()
            ],
        ];
    }
}
