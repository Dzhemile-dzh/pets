<?php

namespace Tests\Controllers\Horses\Profile\Horse;

use \Api\Input\Request\Horses\Profile\Horse\Record as Request;
use Controllers\Horses\Profile\Horse as Controller;
use Tests\Stubs\Data\Horses\Profile\Horse\Record as Stubs;
use UnitTestsComponents\CommonTestCase;
use UnitTestsComponents\Stubs\StubDataInterface;

/**
 * Class RecordTest
 *
 * @package Tests\Controllers\Horses\Profile\Horse
 */
class RecordTest extends CommonTestCase
{
    /**
     * @param Request           $request
     * @param StubDataInterface $stubData
     *
     * @throws \Exception
     * @dataProvider dataProviderActionGetRecord
     */
    public function testActionGetRecord(Request $request, StubDataInterface $stubData)
    {
        $this->initPseudoPdo($stubData);

        $ctrl = new Controller();
        $ctrl->actionGetRecord($request);
        $this->assertControllerResultEqualsJson($ctrl, $stubData);
    }

    /**
     * @return array
     */
    public function dataProviderActionGetRecord()
    {
        return [
            [
                new Request([], ['horseId' => 753194]),
                new Stubs\StubData()
            ],
        ];
    }
}
