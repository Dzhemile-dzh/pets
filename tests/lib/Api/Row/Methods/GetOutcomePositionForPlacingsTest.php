<?php

namespace Tests;

use Phalcon\Exception;

class GetOutcomePositionForPlacingsTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @param \Api\Row\HorseRace $row
     * @param array $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testGetOutcomePositionForPlacings(\Api\Row\HorseRace $row, $expectedResult)
    {
        $this->assertEquals($expectedResult, $row->getOutcomePositionForPlacings());
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return[
            [
                \Api\Row\HorseRace::createFromArray([
                    'race_outcome_position' => 7,
                    'race_outcome_form_char' => '',
                    'disqualification_desc' => ''
                ]),
                7
            ],
            [
                \Api\Row\HorseRace::createFromArray([
                    'race_outcome_position' => 10,
                    'race_outcome_form_char' => '',
                    'disqualification_desc' => ''
                ]),
                0
            ],
            [
                \Api\Row\HorseRace::createFromArray([
                    'race_outcome_position' => 0,
                    'race_outcome_form_char' => 'F',
                    'disqualification_desc' => ''
                ]),
                'F'
            ],
            [
                \Api\Row\HorseRace::createFromArray([
                    'race_outcome_position' => 0,
                    'race_outcome_form_char' => 'F',
                    'disqualification_desc' => 'disq'
                ]),
                'd'
            ],
            [
                \Api\Row\HorseRace::createFromArray([
                    'race_outcome_position' => 7,
                    'race_outcome_form_char' => '',
                    'disqualification_desc' => 'di'
                ]),
                'di'
            ],
        ];
    }
}
