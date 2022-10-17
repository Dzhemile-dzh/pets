<?php

namespace Tests\Controllers\Horses\Profile\Horse;

use Api\Input\Request\Horses\Profile\Horse\AllEntries as Request;
use Controllers\Horses\Profile\Horse as Controller;
use Tests\Stubs\Data\Horses\Profile\Horse\AllEntries as Stubs;
use UnitTestsComponents\CommonTestCase;
use UnitTestsComponents\Stubs\StubDataInterface;

/**
 * Class AllEntriesTest
 * @package Tests\Controllers\Horses\Profile\Horse\AllEntries
 */
class AllEntriesTest extends CommonTestCase
{
    /**
     * @param Request $request
     * @param StubDataInterface $stubData
     * @throws \Exception
     * @dataProvider dataProviderActionGetAllEntries
     */
    public function testActionGetAllEntries(Request $request, StubDataInterface $stubData)
    {
        $this->initPseudoPdo($stubData);

        $ctrl = new Controller();
        $ctrl->actionGetAllEntries($request);
        $this->assertControllerResultEqualsJson($ctrl, $stubData);
    }

    /**
     * @return array
     */
    public function dataProviderActionGetAllEntries()
    {
        return [
            [
                new Request([], ['horseId' => 895090]),
                new Stubs\StubData()
            ],
        ];
    }
}
