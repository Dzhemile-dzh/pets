<?php

namespace Tests\Bo\Horse;

use \Tests\Stubs\Bo\HorseProfile\Medical as TestBo;
use \Api\Input\Request\Horses\Profile\Horse\Medical as Request;
use Phalcon\Mvc\Model\Row\General as GeneralRow;

/**
 * Class MedicalTest
 * @package Tests\Bo\Horse
 */
class MedicalTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param Request $request
     * @param array   $expectedResult
     *
     * @dataProvider providerTestGetMedicalInfo
     */
    public function testGetMedicalInfo($request, $expectedResult)
    {

        $bo = new TestBo($request);
        $this->assertEquals($expectedResult, $bo->getResult());
    }

    /**
     * @return array
     */
    public function providerTestGetMedicalInfo()
    {
        return [
            [
                new \Api\Input\Request\Horses\Profile\Horse\Medical([], ['horseId' => 24]),
                [
                    GeneralRow::createFromArray(
                        [
                            "horse_name" => "Simenon",
                            "medical_info" => GeneralRow::createFromArray(
                                [
                                    GeneralRow::createFromArray(
                                        [
                                            "medical_type" => 'Wing Surgery #1',
                                            "medical_date" => '2015-01-06T00:00:00+00:00'
                                        ]
                                    ),
                                    GeneralRow::createFromArray(
                                        [
                                            "medical_type" => 'Wing Surgery #2',
                                            "medical_date" => '2015-01-04T00:00:00+00:00'
                                        ]
                                    ),
                                ]
                            )
                        ]
                    )
                ]
            ]
        ];
    }
}
