<?php

namespace Tests\Controllers\Horses\OwnerGroups;

use UnitTestsComponents\CommonTestCase;
use UnitTestsComponents\Stubs\StubDataInterface;

use Controllers\Horses\OwnerGroups\TrainerList;
use Api\Input\Request\Horses\OwnerGroups\TrainerList as Request;
use Tests\Stubs\Data\Horses\OwnerGroups\TrainerList as StubData;

/**
 * Class TrainerListTest
 * @package Tests\Controllers\Horses\OwnerGroups
 */
class TrainerListTest extends CommonTestCase
{
    /**
     * @param Request $request
     * @param StubDataInterface $stubData
     *
     * @throws \Exception
     * @dataProvider dataProviderActionGetData
     */
    public function testActionGetData(Request $request, StubDataInterface $stubData)
    {
        $this->initPseudoPdo($stubData);

        $ctrl = new TrainerList();
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
                new StubData\Main\StubData()
            ],
            [
                new Request([], ['ownerGroupId' => 5, 'trainerCountryCode' => 'GB']),
                new StubData\WithParam\StubData()
            ]
        ];
    }
}
