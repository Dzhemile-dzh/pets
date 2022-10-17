<?php

namespace Tests\Controllers\Horses\Profile\Horse;

use Api\Input\Request\Horses\Profile\Horse\Entries as Request;
use Controllers\Horses\Profile\Horse as Controller;
use Tests\Stubs\Data\Horses\Profile\Horse\Entries as Stubs;
use UnitTestsComponents\CommonTestCase;
use UnitTestsComponents\Stubs\StubDataInterface;

/**
 * Class EntriesTest
 * @package Tests\Controllers\Horses\Profile\Horse
 */
class EntriesTest extends CommonTestCase
{
    /**
     * @param Request $request
     * @param StubDataInterface $stubData
     * @throws \Exception
     * @dataProvider dataProviderActionGetEntries
     */
    public function testActionGetEntries(Request $request, StubDataInterface $stubData)
    {
        $this->initPseudoPdo($stubData);

        $ctrl = new Controller();
        $ctrl->actionGetEntries($request);
        $this->assertControllerResultEqualsJson($ctrl, $stubData);
    }

    /**
     * @return array
     */
    public function dataProviderActionGetEntries()
    {
        return [
            [
                new Request([], ['horseId' => 807486]),
                new Stubs\StubData()
            ],
        ];
    }
}
