<?php

namespace Tests\Controllers\Horses\RaceCards;

use Api\Input\Request\Horses\RaceCards\DateRequest as Request;
use Controllers\Horses\RaceCards as Controller;
use Tests\Stubs\Data\Horses\RaceCards\RaceDate as Stubs;
use UnitTestsComponents\CommonTestCase;
use UnitTestsComponents\Stubs\StubDataInterface;

/**
 * @package Tests\Controllers\Horses\RaceCards
 */
class RaceDateTest extends CommonTestCase
{
    /**
     * @param Request $request
     * @param StubDataInterface $stubData
     * @throws \Exception
     * @dataProvider dataProviderActionGetDate
     */
    public function testActionGetDate(Request $request, StubDataInterface $stubData)
    {
        $this->initPseudoPdo($stubData);

        $ctrl = new Controller();
        $ctrl->actionGetDate($request);
        $this->assertControllerResultEqualsJson($ctrl, $stubData);
    }

    /**
     * @return array
     */
    public function dataProviderActionGetDate()
    {
        return [
            [
                new Request(['2018-04-20'], []),
                new Stubs\StubData()
            ],
        ];
    }
}
