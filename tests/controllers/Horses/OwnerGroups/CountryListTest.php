<?php

namespace Tests\Controllers\Horses\OwnerGroups;

use UnitTestsComponents\CommonTestCase;
use UnitTestsComponents\Stubs\StubDataInterface;

use Controllers\Horses\OwnerGroups\CountryList as Controller;
use Api\Input\Request\Horses\OwnerGroups\CountryList as Request;
use Tests\Stubs\Data\Horses\OwnerGroups\CountryList\Main\StubData as StubDataMain;
use Tests\Stubs\Data\Horses\OwnerGroups\CountryList\WithOptionalParameters\StubData as StubDataWithOptionalParameters;

/**
 * Class HorseListTest
 *
 * @package Tests\Controllers\Horses\OwnerGroups
 */
class CountryListTest extends CommonTestCase
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
                new StubDataMain()
            ],
            [
                new Request([], ['ownerGroupId' => 25]),
                new StubDataWithOptionalParameters()
            ]
        ];
    }
}
