<?php

namespace Tests\Stubs\DataProvider\Bo\HorseProfile;

use Phalcon\Mvc\Model\Row\General as GeneralRow;

class Medical extends \Api\DataProvider\Bo\HorseProfile\Medical
{
    /**
     * @param array $horseIds
     *
     * @return array
     */
    public function getMedicalInfo($horseId)
    {
        return [
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
        ];
    }
}
