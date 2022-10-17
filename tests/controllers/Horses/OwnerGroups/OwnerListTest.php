<?php

namespace Tests\Controllers\Horses\OwnerGroups;

use UnitTestsComponents\CommonTestCase;
use UnitTestsComponents\Stubs\StubDataInterface;

use Controllers\Horses\OwnerGroups\OwnerList as Controller;
use Api\Input\Request\Horses\OwnerGroups\OwnerList as Request;
use Tests\Stubs\Data\Horses\OwnerGroups\OwnerList as Stubs;

/**
 * @package Tests\Controllers\Horses\OwnerGroups
 */
class OwnerListTest extends CommonTestCase
{
    /**
     * @param Request           $request
     * @param StubDataInterface $stubData
     *
     * @throws \Exception
     * @dataProvider dataProviderActionGetData
     */
    public function testActionGetData(Request $request, StubDataInterface $stubData)
    {
        $this->initPseudoPdo($stubData);

        $ctrl = new Controller();
        $ctrl->actionGetData($request);
        $this->assertControllerResultEqualsJson($ctrl, $stubData);
    }

    /**
     * @return array
     */
    public function dataProviderActionGetData()
    {
        return [
            [
                new Request([], []),
                new Stubs\Main\StubData()
            ],
            [
                new Request([], ['ownerGroupId' => 5]),
                new Stubs\WithParam\StubData()
            ]
        ];
    }
}
